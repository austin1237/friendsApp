$('.btn').on('click', function (e) {
    e.preventDefault(); // to prevent the default behavior of anchor a click from redirecting.
    var name = $(this).closest('.span4').find('h3').text(); //Get the name of a user from the header
    name = name.split(" ");
    var first_name = name[1];
    var last_name = name[2];
    var button = $(this);
    var button_type = $(button).text();
    var url;
    var params; //parameters for the ajax call
    console.log(button_type);
    switch (button_type) {
    case "Bio":
        params = '{"first_name":"' + first_name +'", "last_name":"' + last_name + '"}';
        url = "index.php/blog/getbio";
        ajax(url, params);
        break;
    case "Daily":
    case "Weekly":
    case "Monthly":
        params = "{first_name: first_name, last_name: last_name button_type: button_type}";
        url = index.php / blog / getbio;
        ajax(url, params);
        break;
    }

    function ajax(url, params) {
        console.log(url);
        console.log(params);
        $.ajax({

            type: "GET",
            url: url,
            data: params,
            datatype: 'json',
            success: function (msg) {
                $(button).text(msg);
                button.slideDown("slow");
            }

        });
        button.hide();
    }

});