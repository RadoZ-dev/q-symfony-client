<?php 
/**
*
* Q Symfony Client
*
* Description: client for connection on Q Symfony Skeleton API (QSS)
*
*/

session_start(); 

$url = 'https://symfony-skeleton.q-tests.com/api/v2/token';

if( $_SERVER[ 'REQUEST_METHOD' ] == 'POST' ) 
{
    $fields = [
        'email'      => isset( $_POST[ 'email' ] ) ? $_POST[ 'email' ] : '',
        'password'   => isset( $_POST[ 'password' ] ) ? $_POST[ 'password' ] : '',
    ];

    $fields = json_encode( $fields );
    $ch = curl_init();

    curl_setopt( $ch, CURLOPT_URL, $url );
    curl_setopt( $ch, CURLOPT_POST, true );
    curl_setopt( $ch, CURLOPT_POSTFIELDS, $fields ); 
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true); 

    $res = curl_exec( $ch );
    $res = json_decode( $res );

    function checkExec( $res ) {
        if( isset( $res->token_key ) )
        {
            $_SESSION[ 'token' ] = $res->token_key;
        }
        else
        {
            throw new Exception( 'Couldn\'t retrieve access token!' );   
        }
    }

    try 
    {
        checkExec( $res );
    } 
    catch( Exception $e )
    {
        echo $e->getMessage();
    }

    // Session timeout implementation
    if ( isset( $_SESSION[ 'LAST_ACTIVITY' ]) 
        && ( time() - $_SESSION[ 'LAST_ACTIVITY' ] > 3 * 60 * 60 )
       ) 
    {
        session_unset();   
        session_destroy();
    }

    $_SESSION[ 'LAST_ACTIVITY' ] = time();
}
?>

<form method="post" action="<?php echo $_SERVER[ 'PHP_SELF' ]; ?>">
  Email: <input type="text" name="email">
  Password: <input type="password" name="password">
  <input type="submit">
</form>