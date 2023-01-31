<?php
include_once "templates/headBoard.php";
include_once "templates/footer.php";
require "vendor/autoload.php";
$client = OpenAI::client('API-KEY-HERE');
$query = "";
$urlImage = "./img/imageDefault.png";
if(isset($_POST["question"])){
    $query = $_POST["question"];
    $image = $_POST["image"];
    $response = $client->images()->create([
        'prompt' => $query,
        'n' => 1,
        'size' => $image,
        'response_format' => 'url',
    ]);
    
    $response->created; 
    
    foreach ($response->data as $data) {
        $urlImage = $data->url; 
    }
}
?>

<div class="conatiner">
    <div>
        <form action="image.php" method="post">
            <div class="header">
                <strong>Select Image Size: </strong>
                    <select name="image">
                    <option value="256x256" selected>256x256</option>
                    <option value="512x512">512x512</option>
                    <option value="1024x1024">1024x1024</option>
                </select>
            </div>
            <div class="containerTextArea">
                <div>
                    <textarea class="fromText" name="question" required placeholder="image features"><?=$query;?></textarea>
                </div>
                <div class="imagen" style="text-align: center">
                    <a href="<?=$urlImage?>" target="_blank">
                        <img src="<?= $urlImage;?>" alt="" srcset="" style="display: block; margin: 0 auto; width: 256px; height: 256px;">
                    </a>

                    
                </div>
            </div>
            <button class="translate">Generate Image</button>
        </form>
    </div>
</div>