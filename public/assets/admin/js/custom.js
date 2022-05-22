var array = [];
if ($(".spec-input").val().length > 3) {
    array = JSON.parse($(".spec-input").val());
}
$(".checked, .not-checked, .optional").click(function (e) {
    if($(".specification").val().length > 3) {
        var status = $(this)[0].classList[$(this)[0].classList.length-1];
        var value = $('.specification').val();
        array.push({'value':value, 'status': status});
        $(".check").append(
            $('<span/>',{text: value + ' ',}).append('<i class="'+$(this).find("i")[0].className+'"></i> <i class="fa fa-trash-alt float-right remove-spec"></i>')
        );
        $(".specification").val('');
    }
});
$(document).on("click", ".remove-spec", function () {
    var value = $(this).parent().text();
    var index = array.map(function (element) { return element.value; }).indexOf(value.trim());
    if (index > -1) {
        array.splice(index, 1);
    }
    $(this).parent().remove();
    
});
$("form").submit(function(){
    if(array.length > 0) {
        $(".spec-input").val(JSON.stringify(array));
    }
});