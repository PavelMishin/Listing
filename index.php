<?php error_reporting(0);
require_once 'listing.php'; ?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Listing</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/4.1.1/normalize.min.css">
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div class="container">
                <form action="index.php" name="upload" method="POST" enctype="multipart/form-data">
                    <label><span class="btn">Choose files</span>
                        <input type="file" name="files[]" value="Choose files" multiple>
                    </label>
                    <label class="file-name"><i>Output file name:</i>
                        <input type="text" name="file-name" value="listing" required>
                        <select name="extention">
                            <option value="txt">txt</option>
                            <option value="doc">doc</option>
                            <option value="rtf">rtf</option>
                        </select>
                    </label>
                    <input type="submit" class="btn" value="Save">
                    <?php require_once 'processing.php';?>
                </form>
        </div>
    </body>
</html>