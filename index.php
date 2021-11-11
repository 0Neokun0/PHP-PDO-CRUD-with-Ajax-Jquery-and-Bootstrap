<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP-CRUD-AJAX_JQUERY-BOOTSTRAP</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="style.css">

</head>
    <body>
            <div class="container box">
                <h1 align="center">PHP PDO CRUD with Ajax Jquery and Bootstrap</h1>
            <br />
            <div align="right"> <!-- It will show Modal for Create new Records !-->
                <button type="button" id="modal_button" class="btn btn-info">Create Records</button>
            </div>
            <br />
            <div id="result" class="table-responsive"> <!-- Data will load under this tag!-->

            </div>
            </div>
    </body>
</html>

<!-- This is Customer Modal. It will be use for Create new Records and Update Existing Records!-->

<div id="customerModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Create New Records</h4>
            </div>
            <div class="modal-body">
                <label>Enter First Name</label>
                <input type="text" name="first_name" id="first_name" class="form-control" />
                <br />
                <label>Enter Last Name</label>
                <input type="text" name="last_name" id="last_name" class="form-control" />
                <br />
            </div>
            <div class="modal-footer">
                <input type="hidden" name="customer_id" id="customer_id" />
                <input type="submit" name="action" id="action" class="btn btn-success" />
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- javascript -->

<script>
$(document).ready(function()
{
    //This function will load all data on web page when page load
    //この関数は、ページの読み込み時にWebページ上のすべてのデータを読み込みます
    fetchUser(); 
     // This function will fetch data from table and display under <div id="result">
     //この関数はテーブルからデータをフェッチし、<div id = "result">の下に表示します
    function fetchUser()
    {
        var action = "Load";
        $.ajax({
        //Request send to "action.php page"
        //「action.phpページ」への送信をリクエスト

        url : "action.php",
        //Using of Post method for send data
        //データを送信するためのPostメソッドの使用
        method:"POST",
        //action variable data has been send to server
        //アクション変数データがサーバーに送信されました
        data:{action:action},
        success:function(data){
            //It will display data under div tag with id result
            //データをdivタグの下に表示し、結果をIDにします

            $('#result').html(data);
        }
        });
    }

        //This JQuery code will Reset value of Modal item when modal will load for create new records
        //このJQueryコードは、新しいレコードを作成するためにモーダルが読み込まれるときにモーダルアイテムの値をリセットします
        $('#modal_button').click(function(){
        $('#customerModal').modal('show'); //It will load modal on web page/モーダルをロードします
        $('#first_name').val(''); //This will clear Modal first name textbox/モーダル名のテキストボックスがクリアされます
        $('#last_name').val(''); //This will clear Modal last name textbox/モーダルの名前のテキストボックスがクリアされます
        $('.modal-title').text("Create New Records"); //It will change Modal title to Create new Records/モーダルタイトルを新しいレコードを作成に変更します。
        $('#action').val('Create'); //This will reset Button value ot Create/ボタンの値がCreateにリセットされます
        });

        
        //This JQuery code is for Click on Modal action button for Create new records or Update existing records. This code will use for both Create and Update of data through modal
        //このJQueryコードは、[新しいレコードの作成]または[既存のレコードの更新]の[モーダルアクション]ボタンをクリックするためのものです。 このコードは、モーダルを介したデータの作成と更新の両方に使用されます
        $('#action').click(function(){
        var firstName = $('#first_name').val(); //Get the value of first name textbox./名のテキストボックスの値を取得します。
        var lastName = $('#last_name').val(); //Get the value of last name textbox/姓のテキストボックスの値を取得します
        var id = $('#customer_id').val();  //Get the value of hidden field customer id///非表示フィールドの顧客IDの値を取得します
        var action = $('#action').val();  //Get the value of Modal Action button and stored into action variable /モーダルアクションボタンの値を取得し、アクション変数に保存します
        if(firstName != '' && lastName != '') //This condition will check both variable has some value/この条件は、両方の変数に何らかの値があることを確認します
        {
        $.ajax({
            url : "action.php",    //Request send to "action.php page"
            method:"POST",     //Using of Post method for send data
            data:{firstName:firstName, lastName:lastName, id:id, action:action}, //Send data to server
            success:function(data){
            alert(data);    //It will pop up which data it was received from server side
            $('#customerModal').modal('hide'); //It will hide Customer Modal from webpage.
            fetchUser();    // Fetch User function has been called and it will load data under divison tag with id result
            }
        });
        }
        else
        {
        alert("Both Fields are Required"); //If both or any one of the variable has no value them it will display this message
        }
        });

        //This JQuery code is for Update customer data. If we have click on any customer row update button then this code will execute
        $(document).on('click', '.update', function(){
        var id = $(this).attr("id"); //This code will fetch any customer id from attribute id with help of attr() JQuery method
        var action = "Select";   //We have define action variable value is equal to select
        $.ajax({
        url:"action.php",   //Request send to "action.php page"
        method:"POST",    //Using of Post method for send data
        data:{id:id, action:action},//Send data to server
        dataType:"json",   //Here we have define json data type, so server will send data in json format.
        success:function(data){
            $('#customerModal').modal('show');   //It will display modal on webpage
            $('.modal-title').text("Update Records"); //This code will change this class text to Update records
            $('#action').val("Update");     //This code will change Button value to Update
            $('#customer_id').val(id);     //It will define value of id variable to this customer id hidden field
            $('#first_name').val(data.first_name);  //It will assign value to modal first name texbox
            $('#last_name').val(data.last_name);  //It will assign value of modal last name textbox
        }
        });
        });

        //This JQuery code is for Delete customer data. If we have click on any customer row delete button then this code will execute
        $(document).on('click', '.delete', function(){
        var id = $(this).attr("id"); //This code will fetch any customer id from attribute id with help of attr() JQuery method
        if(confirm("Are you sure you want to remove this data?")) //Confim Box if OK then
        {
        var action = "Delete"; //Define action variable value Delete
        $.ajax({
            url:"action.php",    //Request send to "action.php page"
            method:"POST",     //Using of Post method for send data
            data:{id:id, action:action}, //Data send to server from ajax method
            success:function(data)
            {
            fetchUser();    // fetchUser() function has been called and it will load data under divison tag with id result
            alert(data);    //It will pop up which data it was received from server side
            }
        })
        }
        else  //Confim Box if cancel then 
        {
        return false; //No action will perform
        }
        });
        });
</script>