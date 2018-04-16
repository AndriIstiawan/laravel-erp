$(function(){$('[data-toggle="tooltip"]').tooltip()});

function convertToSlug(Text){
    return Text.toLowerCase().replace(/[^\w ]+/g,'').replace(/ +/g,'-');
}