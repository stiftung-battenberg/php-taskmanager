<?php
/**
 * Create an task
 * @param string $name of the task  
 * @param string $color of the task
 * @param array $weekdays on which the task should complete must be an array
 * @param integer $group_ids
 */
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

/**
 * updates an task
 * @param integer $id of the task  
 * @param string $name of the task  
 * @param string $color of the task
 * @param array $weekdays on which the task should complete must be an array
 * @param integer $group_ids
 */
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

/**
 * deletes an task
 * @param integer $id of the task
 */
function deleteTask($id) {
    $task = R::load( 'task', $id ); 
    R::trash($task);
}

/**
 * Find all tasks
 * @return array of redbean objects
 */
function getTasks() {
    return R::findAll( 'task' );
}

/**
 * Attributes tasks to users between the given dates
 * @param DateTime object $from
 * @param DateTime object $to 
 */
function gennerateTasks($from, $to){
    // Deletes task who are set in the futur
    $tasked = R::findAll( 'tasked' );

    foreach ($tasked as $t) {
        if(new DateTime($t->start) >= $from) {
            R::trash($t);
        }
    }

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
            
                $userLeast = getUsersWithLeastTask($users)[0];
                $tasked = R::dispense( 'tasked' );
                $tasked->title = $userLeast->name; 
                $tasked->user =  $userLeast;

                $userLeast->doneTask = true;
                R::store($userLeast);

                $tasked->start = $objDateTime; 
                $tasked->color = $task->color;
                $tasked->task = $task;
                R::store($tasked);
            }
        }
        date_add($objDateTime, date_interval_create_from_date_string('1 days'));
    } 
}

// No idea what this is about but why not 
function checkRelation ($group, $groupList){
    $result = false;

    foreach ($groupList as $g) {
        if($group->id == $g->id) {
            $result = true;
        }
    }

    return $result;
}

/**
 * Searches users who have done the least task 
 * @param $user array of redbean objects list of users to check
 * @return $user array of redbean objects
 */
function getUsersWithLeastTask($user) {
    $usersOutput = [];
    
    foreach ($user as $u) {
        if (! $u->doneTask) {
            $usersOutput[] = $u;
        }
    }
    
    if ($usersOutput == []) {
        foreach ($user as $u) {
            $u->doneTask = false;
            R::store($u);
        }
        $usersOutput = $user;
    }
    
    return $usersOutput;
}

/**
 * Formats the tasked task to be display in full callenndar
 * @return 
 */
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

/**
 * Formats the tasked task to be display in full callenndar
 * @return 
 */
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

/**
 * changes the current holder of a task 
 * @param integer $tasked_id 
 */
function changePersonForTask ($tasked_id) {
    $tasked = R::load('tasked', $tasked_id);
    $users = [];
    foreach ($tasked->task->sharedGroup as $group) {
        $users = array_merge($users, $group->ownUserList);
    }
    $user = getUsersWithLeastTask($users)[0];
    $tasked->title = $user->name; 
    $tasked->user =  $user;
    $user->doneTask = true;
    R::store($user);
    R::store($tasked);
}