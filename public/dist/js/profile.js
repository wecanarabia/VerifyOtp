$('#profile-edit').on('click', function(){
    $('#profile-data').hide();
    $('#profile-form').removeClass('d-none');
})

$('#profile-cancel').on('click', function(event){
        event.preventDefault();
    $('#profile-form').addClass('d-none');
    $('#profile-data').show();
})

$('#identity-edit').on('click', function(){
    $('#identity-data').hide();
    $('#identity-form').removeClass('d-none');
})

$('#identity-cancel').on('click',function(event){
    event.preventDefault();
    $('#identity-form').addClass('d-none');
    $('#identity-data').show();
})

$('#work-edit').on('click', function(){
    $('#work-data').hide();
    $('#work-form').removeClass('d-none');
})

$('#work-cancel').on('click',function(event){
    event.preventDefault();
    $('#work-form').addClass('d-none');
    $('#work-data').show();
})

$('#bank-edit').on('click', function(){
    $('#bank-data').hide();
    $('#bank-form').removeClass('d-none');
})

$('#bank-cancel').on('click',function(event){
    event.preventDefault();
    $('#bank-form').addClass('d-none');
    $('#bank-data').show();
})

$('#cat-edit').on('click', function(){
    $('#cat-data').hide();
    $('#cat-form').removeClass('d-none');
})

$('#cat-cancel').on('click',function(event){
    event.preventDefault();
    $('#cat-form').addClass('d-none');
    $('#cat-data').show();
})
