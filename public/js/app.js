var $collectionHolder;
var $collectionHolderVideos;

var $addLink = $('<a href="#" class="add_media_image btn btn-primary">Ajouter une image</a>');
var $newLink = $('<div></div>').append($addLink);

var $addVideo = $('<a href="#" class="add_media_video btn btn-primary">Ajouter une vidéo</a>');
var $newVideo = $('<div></div>').append($addVideo);

let ready = jQuery(document).ready(function() {

    $collectionHolder = $('#trick_mediaImages');
    $collectionHolderVideos = $('#trick_mediaVideos');

    var x = $("#trick_mediaImages>input").length;

    $('.custom-file-input').each(function () {
        $('.custom-file-input').change(function(event) {
            var inputFile = event.currentTarget;
            $(inputFile).parent()
                .find('.custom-file-label')
                .html(inputFile.files.item(x++).name);
        });
    });


    $collectionHolder.find('li').each(function() {
        addFormDeleteLink($(this));
    });

    $collectionHolder.append($newLink);

    $collectionHolder.data('index', $collectionHolder.find(':input').length);

    $addLink.on('click', function(e) {
        e.preventDefault();

        addFileForm($collectionHolder, $newLink);
    });

    ////

    $collectionHolderVideos.find('li').each(function() {
        addFormDeleteVideo($(this));
    });

    $collectionHolderVideos.append($newVideo);

    $collectionHolderVideos.data('index', $collectionHolderVideos.find(':input').length);

    $addVideo.on('click', function(e) {
        e.preventDefault();

        addVideoForm()($collectionHolderVideos, $newVideo);
    });
});


function addFileForm($collectionHolder, $newLink) {
    var prototype = $collectionHolder.data('prototype');

    var index = $collectionHolder.data('index');

    var newForm = prototype;

    newForm = newForm.replace(/__name__/g, index);

    $collectionHolder.data('index', index + 1);

    var $newFormDiv = $('<div></div>').append(newForm);
    $newLink.before($newFormDiv);

    addFormDeleteLink($newFormDiv);
}

function addFormDeleteLink($tagFormDiv) {
    var $removeFormA = $('<a href="#" class="btn btn-danger mb-3">Supprimer</a>');
    $tagFormDiv.append($removeFormA);

    $removeFormA.on('click', function(e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();

        $tagFormDiv.remove();
    });
}

///


function addVideoForm($collectionHolderVideos, $newLink) {
    var prototype = $collectionHolderVideos.data('prototype');

    var index = $collectionHolderVideos.data('index');

    var newForm = prototype;

    newForm = newForm.replace(/__name__/g, index);

    $collectionHolderVideos.data('index', index + 1);

    var $newFormDiv = $('<div></div>').append(newForm);
    $newLink.before($newFormDiv);

    addFormDeleteVideo($newFormDiv);
}

function addFormDeleteVideo($tagFormDiv) {
    var $removeFormA = $('<a href="#" class="btn btn-danger mb-3">Supprimer</a>');
    $tagFormDiv.append($removeFormA);

    $removeFormA.on('click', function(e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();

        $tagFormDiv.remove();
    });
}