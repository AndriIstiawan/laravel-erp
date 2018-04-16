//note : urutan nested sort jquery
//1. document ready
//2. declare var updateOutput
//3. declare nestable
//4. callback updateOutput
$(document).ready(function()
{
    var updateOutput = function(e)
    {
        var list   = e.length ? e : $(e.target),
            output = list.data('output');
        if (window.JSON) {
            output.val(window.JSON.stringify(list.nestable('serialize')));
        } else {
            output.val('JSON browser support required for this demo.');
        }
    };

    $('#nestable3').nestable({
        maxDepth: 99
    }).on('change', updateOutput);

    updateOutput($('#nestable3').data('output', $('#nestable-output')));
});