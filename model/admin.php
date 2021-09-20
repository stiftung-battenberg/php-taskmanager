<?php 

function createAdmin ($name, $password) {
    $user = R::dispense( 'admin' );
    $user->name = $name;
    $user->password = password_hash($password, PASSWORD_BCRYPT);
    return R::store( $user );
}

function updateAdmin($id, $name, $password) {
    $user = R::load( 'admin', $id );
    $user->name = $name;
    $user->password = password_hash($password, PASSWORD_BCRYPT);
    R::store( $user );
}

function checkAdmin ($name, $password) {

    $admin  = R::find( 'admin', "name = '" . $name . "'");

    if($admin != []) {
        return password_verify($password, reset($admin)->password);  
    } else {
        return false;
    }
}

function getAdmin() {
    $users = R::findAll( 'admin' );
    return $users;
}

function deleteAdmin($id) {
    $user = R::load( 'admin', $id ); 
    R::trash( $user );
}

function createDefaultAdmin ($username, $password) {
    $admins = R::findAll( 'admin' );
    if($admins == []) {
        $user = R::dispense( 'admin' );
        $user->name = $username;
        $user->password = password_hash($password, PASSWORD_BCRYPT);
        return R::store( $user );
    }
}