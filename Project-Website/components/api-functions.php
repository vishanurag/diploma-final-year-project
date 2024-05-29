<?php
// ALL API FUNCTIONS ARE WRITTERN OVER HERE... START
function askGPT2($api_key,) {
    $endpoint = "https://api.openai.com/v1/chat/completions";
    $headers = array(
        "Content-Type: application/json",
        "Authorization: Bearer " . $api_key
    );
    $result = "";
    $data = array(
        "model" => "gpt-3.5-turbo",  // Specify the desired model
        "messages" => array(
            array("role" => "user", "content" => ($_POST['prompt'].". Based on this quote give me the main motive of this business under 5 words."))
            )
        );
        
        $ch = curl_init($endpoint);           
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        
        $response = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error: ' . curl_error($ch);
        }
        
        curl_close($ch);
        
        $result = json_decode($response, true);
        
        $result = (($result['choices'][0]['message']['content']))? $result['choices'][0]['message']['content']: "Opps! Something Went Wrong...";
        // echo '<script>console.log('.$result.')</script>';
        return ($result);
    }
function askGPT($api_key, $pagename) {
    $endpoint = "https://api.openai.com/v1/chat/completions";
    $headers = array(
        "Content-Type: application/json",
        "Authorization: Bearer " . $api_key
    );
    $result = "";
    $data = array(
        "model" => "gpt-3.5-turbo",  // Specify the desired model
        "messages" => array(
            array("role" => "user", "content" => ($_POST['prompt'].". Based on above quote, give a crisp discription for ".$pagename." page of our website."))
            )
        );
        
        $ch = curl_init($endpoint);           
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        
        $response = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error: ' . curl_error($ch);
        }
        
        curl_close($ch);
        
        $result = json_decode($response, true);
        try {
            $result = $result['choices'][0]['message']['content'];
        } catch (\Throwable $th) {
            $result = askGPT($api_key, $pagename);
        }
        // $result = (($result['choices'][0]['message']['content']))? $result['choices'][0]['message']['content']: "Opps! Something Went Wrong...";
        // echo '<script>console.log('.$result.')</script>';
        return ($result);
    }


    function askDELLE3($api_key, $pagename) {
        $endpoint = "https://api.openai.com/v1/images/generations";
        $headers = array(
            "Content-Type: application/json",
            "Authorization: Bearer " . $api_key
        );

        $result = "";

        $data = array(
            // "model" => "delle-3",
            "prompt"=> ($GLOBALS['imageprompt']),
            "n"=> 1,
            "size"=> "512x512",
        );
            
            
        $ch = curl_init($endpoint);  
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $response = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error: ' . curl_error($ch);
        }
        curl_close($ch);

        $result = json_decode($response, true);
        
        $image = ($result['data'][0]['url'])? ($result['data'][0]['url']): 'n';
        // echo "<img src='".$image."' />";

        return $image;
    }
// ALL API FUNCTIONS ARE WRITTERN OVER HERE... END

?>