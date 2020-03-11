
//batch number


    //Make an Ajax request to a PHP script called car-models.php
    //This will return the data that we can add to our Select element.
    $.ajax({
        url: 'data/batch_number.php',
        type: 'get',


        success: function (data) {

            //Log the data to the console so that
            //you can get a better view of what the script is returning.
            console.log(data);

            $.each(data, function (key, modelName) {
                //Use the Option() constructor to create a new HTMLOptionElement.
                var option = new Option(modelName, modelName);
                //Convert the HTMLOptionElement into a JQuery object that can be used with the append method.
                $(option).html(modelName);
                //Append the option to our Select element.
                $("#batch_search").append(option);
            });

            //Change the text of the default "loading" option.
            $('#batch_value').text('--batch detail--');

        }
    });





