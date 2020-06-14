function updateSelect(name, array)
{
    var selectElement = document.forms[0].elements[name];
    
    selectElement.innerHTML = "";

    for(var i=0; i<array.length; i++)
        selectElement.innerHTML += "<option value='"+ array[i] +"'>"+ array[i] +"</option>";
}

function request(url, data, success)
{
    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (this.status == 200 && this.readyState == 4)
            success(this.responseText);
    };
    r.open("POST", url);
    r.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    r.send(data);
}

function typeAnimation(input, value, delay=50)
{
    var pointer = 0;

    var interval = setInterval(function()
    {
        if (pointer == value.length)
            clearInterval(interval);

        input.val(value.substr(0, (pointer++) + 1));
    }, delay);
}

$(document).ready(function (){

    // Menu Items
    $(".menu > .nav-item").click(function ()
    {
        if ($(this).hasClass("item-active")) return;
        
        // Remove the active state from the active element
        $(".menu > .nav-item").removeClass("item-active");
        // Slide up all slided down sub menus
        $(".sub-menu").slideUp(500);
        // Activate the clicked item
        $(this).addClass("item-active");
        // Slide down the sub-menu
        $(this).next().slideDown(500);
    });

    // Display a students code
    $("select[name='in_branch']").change(function()
    {
        // Collect criterias
        var data = $(this).val();

        request("./ajax/get_student.php", "classe="+data, function(r)
        {
            // Parse to JSON
            var data = JSON.parse(r);

            var cnes = [];
            for (var i=0; i<data.length; i++)
                cnes.push (data[i].cne);

            updateSelect("in_cne", cnes);

            $("select[name='in_cne']").prepend("<option value='-1'>Select a CNE</option>");
            $("select[name='in_cne']").val(-1);
        });

    });

    $("select[name='in_cne']").change(function()
    {
        // Collect criterias
        var data = $(this).val();

        request("./ajax/get_student.php", "cne="+data, function(r)
        {
            // Parse to JSON
            var data = JSON.parse(r);
            // Display result
            if (data.length > 0)
                typeAnimation($("#out_name"), data[0].nom);
        });

    });
});