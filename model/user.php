<?php 

function createUser ($name, $email) {
    $user = R::dispense( 'user' );
    $user->name = $name;
    $user->email = $email;
    return R::store( $user );
}

function updateUser($id, $name, $email) {
    $user = R::load( 'user', $id );
    $user->name = $name;
    $user->email = $email;
    R::store( $user );
}

function getUser() {
    $users = R::findAll( 'user' );
    return $users;
}

function deleteUser($id) {
    $user = R::load( 'user', $id ); 
    R::trash( $user );
}

function getUserByGroup($group_id) {
    return R::find('user', 'group_id = '. $group_id);
}