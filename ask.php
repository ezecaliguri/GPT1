<?php
    include_once "templates/headBoard.php";
    include_once "templates/footer.php";
    require "vendor/autoload.php";
    $query = "";
    $result = ["choices" => [0 => ["text" => ""]]];
    if(isset($_POST["question"])){
        $client = OpenAI::client('API-KEY-HERE');
        $query = $_POST["question"];
        $temperature = intval($_POST["temperature"]);
        $Tokens = intval($_POST["Tokens"]);
        $model = $_POST["model"];
        $result = $client->completions()->create([
            'model' => $model,
            'prompt' => $query,
            'max_tokens' => $Tokens,
            'temperature' => $temperature ,
        ]);
    }
?>
<div class="conatiner">
    <div>
        <form action="ask.php" method="post">
            <div class="header">
                <strong>Select Model: </strong>
                    <select name="model">
                    <option value="babbage">babbage</option>
                    <option value="ada">ada</option>
                    <option value="curie">curie</option>
                    <option value="text-davinci-003" selected>text-davinci-003</option>
                    <option value="curie-instruct-beta">curie-instruct-beta</option>
                </select>
                <strong>Select Characters: </strong>
                <select name="Tokens">
                    <option value="28">50</option>
                    <option value="56">100</option>
                    <option value="85">150</option>
                    <option value="115" selected>200</option>
                    <option value="288">500</option>
                    <option value="576">1000</option>
                </select>
                <strong>Select Temperature: </strong>
                <select name="temperature">
                    <option value="0"selected>0</option>
                    <option value="0,2">0.2</option>
                    <option value="0,4">0.4</option>
                    <option value="0,6">0.6</option>
                    <option value="0,8">0.8</option>
                    <option value="1">1</option>
                </select>
            </div>
            <div class="containerTextArea">
                <div>
                    <textarea class="fromText" name="question" required placeholder="Do you have any question?"><?= $query?></textarea>
                </div>
                <div>
                    <textarea class="toText" readonly><?=$result['choices'][0]['text'];?></textarea>
                </div>
            </div>
            <button class="translate">Ask</button>
        </form>
    </div>
</div>