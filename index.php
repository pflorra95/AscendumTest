
<html>
    <body>
        <h3>Welcome to Lucky 7 Game</h3>
        <br/><br/>
        <p>Place your bet (Rs 10):<br/>
        <form id="game" method="post" action="">
            <input type="radio" id="below-7" name="betType" value="below-7">Below 7
            <input type="radio" id="exact-7" name="betType" value="exact-7">7
            <input type="radio" id="above-7" name="betType" value="above-7">Above 7
            <input type="hidden" id="balance_value" name="balance_value" value="100">
            <br/>
            <br/>
            <input type="radio" id="reset" name="action_buttons" value="reset"> Reset and Play Again
            <input type="radio" id="continue" name="action_buttons" value="continue"> Continue Playing
            <br/>
            <br/>
            <button id="play" name="submit" value="submit">Play</button>
        </form>
        
        </p>
        
        
        <p id="result_span"></p>
        
    </body>
</html>

<?php

if(isset($_POST['submit']))
{
    $balance = $_POST['balance_value'];

    $moveAhead = true;
    if($_POST['action_buttons'] == "continue" && !isset($_POST['betType'])){
        $moveAhead = false;
    } elseif($_POST['action_buttons'] == "reset")
    {
        if(isset($_POST['betType'])){
            $balance = 100;
        } elseif(!isset($_POST['betType']))
        {
            $moveAhead = false;
        }
        
    }
    
    if($moveAhead)
    {
        function checkBalance($bal, $action, $amount)
        {
            $balance = $bal;
            if($action == "minus")
            {
                $balance = $balance - $amount;
            } elseif($action == "pluse")
            {
                $balance = $balance + $amount;
            }
            
            return $balance;
        }
        
        $output = checkBalance($balance, "minus", 10);
        
        $betType = $_POST['betType'];
        $dice1_value = random_int(1, 6);
        $dice2_value = random_int(1, 6);
        $sum = $dice1_value + $dice2_value;
        
        echo "<br><br>Game Results";
        echo "<br> Bet Type : ".$betType;
        echo "<br> Dice 1 : ".$dice1_value;
        echo "<br> Dice 2 : ".$dice2_value;
        echo "<br><br> Total : ".$sum."<br>";
        
        
        
        if($betType == 'below-7')
        {
            if($sum < 7)
            {
                $output = checkBalance($output, "pluse", 20);
                echo "<script>alert('Won'); document.getElementById('balance_value').value = $output; </script>";
                echo "Congratulations you win! your balance is now ".$output;
            } else {
                echo "<script>alert('Lost'); document.getElementById('balance_value').value = $output; </script>";
                
                echo "You lost. Your balance is now ".$output;
            }
        } elseif($betType == 'exact-7')
        {
            if($sum == 7)
            {
                $output = checkBalance($output, "pluse", 30);
                echo "<script>alert('Won'); document.getElementById('balance_value').value = $output; </script>";
                echo "Congratulations you win! your balance is now ".$output;
            } else {
                echo "<script>alert('Lost'); document.getElementById('balance_value').value = $output; </script>";
                echo "You lost. Your balance is now ".$output;
            }
        } elseif($betType == 'above-7')
        {
            if($sum > 7)
            {
                $output = checkBalance($output, "pluse", 20);
                echo "<script>alert('Won'); document.getElementById('balance_value').value = $output; </script>";
                
                echo "Congratulations you win! your balance is now ".$output;
            } else {
                echo "<script>alert('Lost'); document.getElementById('balance_value').value = $output; </script>";
                echo "You lost. Your balance is now ".$output;
            }
        }
    } else {
        echo "<script>alert('Please Choose the Bet Type'); </script>";
    }
}
?>
