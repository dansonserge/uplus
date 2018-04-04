<?php

// START INITIATE
    include ("db.php");
    // var_dump($_SERVER["REQUEST_METHOD"]);
    if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {
        if(isset($_POST['action']))
        {
            $_POST['action']();
        }
        else
        {
            echo 'Please read the API documentation';
        }
    }
    else
    {
        echo 'UPLUS API V02';
    }
// END INITIATE

// FORUMS
     function list_forums()
    {
        require('db.php');
        $query = $churchDb->query("SELECT * FROM forums")or die(mysqli_error($churchDb));
        $forums = array();
        while ($forum = mysqli_fetch_array($query))
        {
            $forums[] = array(
                "forumId"   => $forum['id'],
                "forumTitle"    => $forum['forumtitle'],
                "joined"        => "1"
            );
        }
        header('Content-Type: application/json');
        $forums = json_encode($forums);
        echo $forums;
    }

    function joinForum()
    {
        require('db.php');
        $forumId            = mysqli_real_escape_string($db, $_POST['forumId']);
        $phone              = mysqli_real_escape_string($db, $_POST['phone']);
        
        //CLEAN PHONE
        $invitedPhone   = preg_replace( '/[^0-9]/', '', $invitedPhonearray );
        $invitedPhone   = substr($invitedPhone, -10); 

        //CHECK FOR POISON
        $sqlPoison = $db->query("SELECT id FROM groups WHERE id =  '$groupId'") or (mysqli_error());
        if(mysqli_num_rows($sqlPoison) > 0)
        {

            $sql = $db->query("SELECT id FROM users WHERE phone =  $invitedPhone") or (mysqli_error());
            $countUsers = mysqli_num_rows($sql);
            if($countUsers > 0)
            {
                //GET EXISTING USER
                $invitedArray = mysqli_fetch_array($sql);
                $invitedId = $invitedArray['id'];
            }
            else
            {
                //CREATE THE NEW USER
                $code = rand(0000, 9999);
                $db->query("INSERT INTO 
                    users (phone,createdBy,createdDate, password, updatedBy, updatedDate) 
                    VALUES  ('$invitedPhone', '$invitorId', now(), '$code', '$invitorId', now() )
                    ");
                if($db)
                {
                    $sql            = $db->query("SELECT id FROM users ORDER BY id DESC LIMIT 1");
                    $invitedArray   = mysqli_fetch_array($sql);
                    $invitedId      = $invitedArray['id'];
                }
            }

            // CHECK IF THE USER IS ALREADY IN THE GROUP
            $sql = $db->query("SELECT * FROM groupuser WHERE groupId ='$groupId' AND userId='$invitedId'");
            $checkExits = mysqli_num_rows($sql);
            if($checkExits > 0)
            {
                // CHECK IF THE USER DID LEAVE BEFORE
                $sql1 = $db->query("SELECT * FROM groupuser WHERE (groupId ='$groupId' AND userId='$invitedId') AND archive = 'YES'");
                $checkExits1 = mysqli_num_rows($sql1);
                if($checkExits1 > 0)
                {
                    // BRING THE USER BACK IN THE GROUP
                    $sql = $db->query("UPDATE groupuser SET archive = null WHERE groupId ='$groupId' AND userId='$invitedId'");
                    // CHECK IF THE LIST OF TREASURERS IS NOT FULL AND ADD HIM
                    $sqlList = $db->query("SELECT * FROM groupuser WHERE groupId = '$groupId' AND type = 'Group treasurer'");
                    if(mysqli_num_rows($sqlList) <= 2)
                    {
                        // THERE IS SOME PLACE FOR YOU
                        $sql = $db->query("UPDATE groupuser SET type = 'Group treasurer' WHERE groupId ='$groupId' AND userId='$invitedId'");
                        echo 'Became treasurer';
                    }
                    echo 'Member '.$invitedPhone.', is brought back in the group';
                }
                else
                {
                    echo 'Member '.$invitedPhone.', is already in the group';
                }
            }
            else
            {
                // PREPARE MEMBER TYPE
                $getMemberType= $db->query("SELECT * FROM groupuser WHERE groupId='$groupId' AND type = 'Group treasurer'");
                $countTres = mysqli_num_rows($getMemberType);
                if($countTres >= 3)
                {
                    $memberType = '';
                }
                else
                {
                    $memberType = 'Group treasurer';
                }

                // ADD MEMBER FOR THE FIRST TIME IN THIS GROUP
                $sql = $db->query("INSERT INTO groupuser (joined, groupId, userId, type, createdBy, createdDate, updatedBy, updatedDate) 
                    VALUES ('yes','$groupId','$invitedId','$memberType','$invitorId', now(), '$invitorId', now())")or die(mysqli_error($db));

                if($db)
                {
                    $gnamesql   = $db->query("SELECT groupName FROM groups WHERE id = '$groupId' LIMIT 1");
                    $loopg      = mysqli_fetch_array($gnamesql);
                    $groupName  = $loopg['groupName'];
                    $recipients = '+25'.$invitedPhone;
                    $message    = 'You have been invited to join '.$groupName.' (a contribution group on UPlus). for more info, click here. https://xms9d.app.goo.gl/PeSx or *801*2# use '.$groupId.' as a group number';

                    $data = array(
                                "sender"        =>'UPLUS',
                                "recipients"    =>$recipients,
                                "message"       =>$message,
                            );
                    include 'sms.php';
                    if($httpcode == 200)
                    {
                        echo 'Member with '.$invitedPhone.' is added';
                    }
                    else
                    {
                        echo 'System error';
                    }
                }
                else
                {
                    'The user is not invited';
                }
            }
        }
        else
        {
            echo "Poison Detected: ".$groupId;
        }
    }

    function exitForum()
    {
        include "db.php";
        $forumId    = mysqli_real_escape_string($db, $_POST['forumId']);
        $memberId   = mysqli_real_escape_string($db, $_POST['memberId']);   

        $sql = $db->query("UPDATE forumuser SET archive = 'YES', archivedDate = now() WHERE groupId = '$memberId' AND userId = '$memberId'")or die(mysqli_error($db));
        echo 'You are no longer in this forum'.$groupName.'.';
    }

// FORUMS
?>