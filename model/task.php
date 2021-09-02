<?php

function createTask ($name, $color, $weekdays, $group_ids) {
    $task = R::dispense( 'task' );
    $task->name = $name;
    $task->weekdays = json_encode($weekdays);
    $task->color = $color;
    foreach ($group_ids as $id) {
        $group = R::load('group', $id);
        $task->sharedGroupList[] = $group;
    }
    R::store($task);
}

function updateTask ($id, $name, $color, $weekdays, $group_ids) {
    $task = R::load('task', $id);
    $task->name = $name;
    $task->weekdays = json_encode($weekdays);
    $task->color = $color;
    $tasks = R::find('group_task', 'task_id = ' . $id);
    foreach($tasks as $t) {
        R::trash($t);
    }
    foreach ($group_ids as $id) {
        $group = R::load('group', $id);
        $task->sharedGroupList[] = $group;
    }
    R::store($task);
}

function deleteTask($id) {
    $task = R::load( 'task', $id ); 
    R::trash($task);
}

function getTasks() {
    return R::findAll( 'task' );
}

function gennerateTasks($from, $to){
    R::wipe( 'tasked' );

    $tasks = R::findAll( 'task' );

    $objDateTime =  new DateTime($from->format('c'));
    

    while($objDateTime <=  $to){
        foreach($tasks as $task) {

            $weekdays = json_decode($task->weekdays);
            $users = [];
            foreach ($task->sharedGroup as $group) {
                $users = array_merge($users, $group->ownUserList);
            }

            if (in_array($objDateTime->format('l'), $weekdays)) {

                $userLeast = getUsersWithLeastTask($users);
                $tasked = R::dispense( 'tasked' );
                $tasked->title = $userLeast[0]->name; 
                $tasked->user =  $userLeast[0];
                $tasked->start = $objDateTime; 
                $tasked->color = $task->color;
                $tasked->task = $task;
                R::store($tasked);
            }
        }
        date_add($objDateTime, date_interval_create_from_date_string('1 days'));
    } 
}

function checkRelation ($group, $groupList){
    $result = false;

    foreach ($groupList as $g) {
        if($group->id == $g->id) {
            $result = true;
        }
    }

    return $result;
}

function getUsersWithLeastTask($user) {
    $least = 1000;
    $usersOutput = [];
    foreach ($user as $u) {
        if($least > count($u->ownTaskedList)) {
            $least = count($u->ownTaskedList);
        }
    }
    print($least);
    foreach ($user as $u) {
        if (count($u->ownTaskedList) == $least) {
            $usersOutput[] = $u;
            
        }
    }
    
    return $usersOutput;
}

function getTaskedAdmin() {
    $taskeds = R::findAll( 'tasked' );
    $array = [];
    foreach ($taskeds as $tasked) {
        $task['title'] = $tasked->title;
        $task['start'] = $tasked->start;
        $task['backgroundColor'] = $tasked->color;
        $task['borderColor'] = $tasked->color;
        $task['allDay'] = true;
        $task['url'] = '/admin/sick.php?tasked_id=' . $tasked->id;
        $array[] = $task;
    }
    return $array;
}

function getTasked() {
    $taskeds = R::findAll( 'tasked' );
    $array = [];
    foreach ($taskeds as $tasked) {
        $task['title'] = $tasked->title;
        $task['start'] = $tasked->start;
        $task['backgroundColor'] = $tasked->color;
        $task['borderColor'] = $tasked->color;
        $task['allDay'] = true;
        $array[] = $task;
    }
    return $array;
}

function changePersonForTask ($tasked_id) {
    $tasked = R::load('tasked', $tasked_id);
    $users = [];
    foreach ($tasked->task->sharedGroup as $group) {
        $users = array_merge($users, $group->ownUserList);
    }
    $user = getUsersWithLeastTask($users)[0];
    $tasked->title = $user->name; 
    $tasked->user =  $user;

    R::store($tasked);
}