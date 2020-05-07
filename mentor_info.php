<?php
require("connect_db.php");
$action = "list_tasks"; 
?>

<?php
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        include("mentor_detail_info.php");
    }
    else if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        // when click on the Update Information button, get all inofrmation of the mentor from mentor database and store them into user_to_update array
        if (!empty($_POST['action']) && ($_POST['action'] == 'Update Information'))
        {
            $user_to_update = get_user($_POST['mentor_id']);		
            include('update_form.php');
        
            if (!empty($_POST['university']) && !empty($_POST['field']) && !empty($_POST['degree']) && !empty($_POST['company']) && !empty($_POST['title']) && !empty($_POST['phone']))
            {
                // update mentor information to the mentor table if there is change in the form
                updateMentorInfo($_POST['university'], $_POST['field'], $_POST['degree'], $_POST['company'], $_POST['title'], $_POST['phone'], $_POST['mentor_id']);
            }
    
        }
    }


    function get_user($mentor_id) {
        global $db;

        $query = "SELECT * FROM mentor where mentor_id = :mentor_id";
        $statement = $db->prepare($query);
        $statement->bindValue(':mentor_id', $mentor_id);
        $statement->execute();

        $results = $statement->fetch();
        $statement->closecursor();

        return $results;
    }



    function updateMentorInfo($university, $field, $degree, $company, $title, $phone, $mentor_id)
    {
        global $db;      
        $query = "UPDATE mentor SET university=:university, field=:field, degree=:degree, company=:company, title=:title, phone=:phone WHERE mentor_id=:mentor_id";
        $statement = $db->prepare($query);
        $statement->bindValue(':university', $university);
        $statement->bindValue(':field', $field);
        $statement->bindValue(':degree', $degree);
        $statement->bindValue(':company', $company);
        $statement->bindValue(':title', $title);
        $statement->bindValue(':phone', $phone);
        $statement->bindValue(':mentor_id', $mentor_id);
        $statement->execute();
        $statement->closeCursor();
    }



    
?>