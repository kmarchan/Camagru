<?php include('server.php'); ?>
<?php

if (isset($_POST['uploadsubmit']))
{
    if (isset($_FILES['file']['name']) && !empty($_FILES['file']['name']))
    {
        $file = $_FILES['file'];

        $fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];
        $fileSize = $file['size'];
        $fileError = $file['error'];
        $fileType = $file['type'];

        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));

        $sizeCheck = getimagesize($fileTmpName);

        $allowed = array('jpg', 'jpeg', 'png');
        if (in_array($fileActualExt, $allowed))
        {
            if ($sizeCheck)
            {
                if ($fileError === 0)
                {
                    if ($fileSize < 5000000)
                    {
                        $_SESSION['image_loc_tmp'] = $fileTmpName;
                        $imagedata = file_get_contents($fileTmpName);
                        $base64 = base64_encode($imagedata);
                        $_SESSION['image_tmp'] = $base64;
                        $_SESSION['image_type'] = strtolower($fileType);
                        header("Location: upload_edit.php");
                    }
                    else
                    {
                        $_SESSION['error'] = "Your File is too big, 5mb max";
                        header("Location: upload_edit.php?Size_fail");
                    }
                }
                else
                {
                    $_SESSION['error'] = "Error Uploading";
                    header("Location: upload_edit.php?Upload_fail");
                }
            }
            else
            {
                $_SESSION['error'] = "Conflicting ext types";
                header("Location: upload_edit.php?Ext_fail");
            }
        }
        else
        {
            $_SESSION['error'] = "$fileActualExt is not allowed! <br />
            jpg, jpeg or png ONLY";
            header("Location: upload_edit.php?Ext_fail");
        }
    }


    else
    {
        $_SESSION['error'] = "Require a file!";
        header("Location: upload_edit.php?Input_fail");
    }

}

?>