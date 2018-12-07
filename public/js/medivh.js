//---fungsi ajax global taruh sini jadi ga bikin berkali guys.. tinggal load trus pake.. ciaoyouuu ^_^
//Medivh as strong as Jody
function validateNumber(event) {
    var key = window.event ? event.keyCode : event.which;
    if (event.keyCode === 8 || event.keyCode === 46) {
        return true;
    } else if ( key < 48 || key > 57 ) {
        return false;
    } else {
        return true;
    }
}
