<?php
    include_once "templates/headBoard.php";
    include_once "templates/footer.php";
    require "vendor/autoload.php";
    $client = OpenAI::client('API-KEY-HERE');
    $query = "";
    $textResult = "";
    if(isset($_POST["question"])){
        $query = $_POST["question"];
        $instruction = $_POST["instruction"];
        $response = $client->edits()->create([
            'model' => 'text-davinci-edit-001',
            'input' => $query,
            'instruction' => $instruction,
        ]);

        foreach ($response->choices as $result) {
            $textResult = $result->text; 
        }
    }
?>

<div class="conatiner">
    <div>
        <form action="reWordText.php" method="post">
            <div class="header">
                <strong>Select Instruction: </strong>
                <select name="instruction">
                    <option value="Fix the spelling mistakes">Fix the spelling mistakes</option>
                    <option value="Explain the text with other words">Explain the text with other words</option>
                </select>
            </div>
            <div class="containerTextArea">
                <div>
                    <textarea class="fromText" name="question" required placeholder="Text to review"><?=$query;?></textarea>
                </div>
                <div style="text-align: center">
                    <textarea class="toText" readonly><?=$textResult;?></textarea>
                </div>
            </div>
            <button class="translate">Resolution Errors</button>
        </form>
    </div>
</div>