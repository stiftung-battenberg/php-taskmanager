<?php

function createGroup ($name) {
    $group = R::dispense( 'group' );
    $group->name = $name;
    $id = R::store( $group );
}

function updateGroup($id, $name) {
    $group = R::load( 'group', $id );
    $group->name = $name;
    R::store( $group );
}

function getGroup() {
    $group = R::findAll( 'group' );
    return $group;
}

function loadGroup($id) {
    return R::load( 'group', $id ); 
}

function deleteGroup($id) {
    $group = R::load( 'group', $id ); 
    R::trash($group);
}

function addUserToGroup($idGroup, $idUser) {
    $group = R::load( 'group', $idGroup );
    $user = R::load( 'user', $idUser );
    $group->ownUserList[] = $user;
    R::store( $group );
}
