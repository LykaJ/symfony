
var $collectionHolder;

var $addLink = $('<a href="#" class="add_media_image btn btn-primary">Ajouter une image</a>');
var $newLink = $('<div></div>').append($addLink);

jQuery(document).ready(function() {

    $collectionHolder = $('#trick_mediaImages');
    $collectionHolderVideos = $('#trick_mediaVideos');

    $collectionHolder.find('li').each(function() {
        addFormDeleteLink($(this));
    });

    $collectionHolder.append($newLink);

    $collectionHolder.data('index', $collectionHolder.find(':input').length);

    $addLink.on('click', function(e) {
        e.preventDefault();

        addFileForm($collectionHolder, $newLink);
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

