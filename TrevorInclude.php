<?php
    function WriteHeaders ($Heading="Welcome", $TitleBar="MySite", $cssFile = "")
    {
        echo 
        "
            <!doctype html>
            <html lang = \"en\">
                <head>
                    <meta charset = \"UTF-8\">
                    <title>$TitleBar</title>
                    <link rel =\"stylesheet\" type = \"text/css\" href=\"$cssFile\"/>
                </head>
                <body>     
                    <h1>$Heading</h1>
        ";
        
    }

    function DisplayLabel($prompt)
    {
        echo "<label>" . $prompt . "</label>";
    }

    function DisplayTextbox($name, $size, $type = "text", $value = 0)
    {
        echo 
        "
            <input type = $type name = \"$name\" Size = $size value = \"$value\">
        ";
    }

    function DisplayContactInfo()
    {
        echo 
        "
            <footer>
                Questions? Comments? 
                <a href = \"mailto:trevor.withers@student.sl.on.ca\">trevor.withers@student.sl.on.ca</a> 
            </footer>   
              
        ";
    }

    function DisplayImage($fileName, $height, $width, $alt)
    {
        echo 
        "
            <img src = $fileName height = $height width = $width alt = $alt>
        ";
    }

    function DisplayButton($name, $text, $fileName = "", $alt = "")
    {
        if(!$fileName == "")
        {
            echo
            "
                <button type = Submit name = $name>"; DisplayImage($fileName, 30, 80, $alt); echo "</button>
            ";
        }
        else
        {
            echo
            "
                <button type = Submit name = $name>$text</button>
            ";
        }
    }

    function CreateConnectionObject()
    {
        $fh = fopen("../auth.txt", "r");
        $Host = trim(fgets($fh));
        $UserName = trim(fgets($fh));
        $Password = trim(fgets($fh));
        $Database = trim(fgets($fh));
        $Port = trim(fgets($fh));
        fclose($fh);
        $mysqlObj = new mysqli($Host, $UserName, $Password, $Database, $Port);
        if($mysqlObj->connect_errno != 0)
        {
            echo "<p>Connection failed. Unable to open database $Database. Error: "
            . $mysqlObj->connect_error . "</p>";
            exit;
        }
        return ($mysqlObj);
    }

    function DropTable(&$mysqlObj, $TableName)
    {
        $query = "Drop Table if exists $TableName";
        $stmtObj = $mysqlObj->prepare($query);
        $stmtObj = $mysqlObj->execute();
    }

    function WriteFooters()
    {
        DisplayContactInfo();
        echo "</body>\n";
        echo "</html>\n";
    }
?>