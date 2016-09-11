( function(){

    "use strict";

    var $target,
        $title,
        $description,
        sTitle,
        sDescription,
        titleTemplate,
        descriptionTemplate;

    var alertBox = function( type, message ) {
        var a = document.createElement( "a" );
        var m = document.createTextNode( message );

        a.classList.add( 'animated');
        a.classList.add( 'bounceInDown' );
        a.classList.add( 'alert');
        a.classList.add( 'alert--' + type );
        a.href = "#";
        a.appendChild( m );
        $( 'body' ).prepend( a );
    }

    var reset = function( e, abort ) {
        var defaultTitleTemplate = $( "<h2 class='work__title'></h2>" ),
            defaultDescriptionTemplate = $( "<p class='work__description'></p>" );

        e.preventDefault();
        $( '.adminToolBar__link--save' ).hide();
        $( '.adminToolBar__link--abort' ).hide();
        $( '.adminToolBar__link--edit' ).show();

        defaultTitleTemplate.html( !abort && $( '.editForm__input--title' ).val() || sTitle );
        $( '.editForm__input--title' ).replaceWith( defaultTitleTemplate );
        defaultDescriptionTemplate.html( !abort && $( '.editForm__input--description' ).val() || sDescription );
        $( '.editForm__input--description' ).replaceWith( defaultDescriptionTemplate );
    };

    var setTarget = function( e ) {
        $target = $( e.target ).attr( 'href' );
        $target = $target.slice(1, $target.length);
    }

    var closeOrShowAdminForm = function( e ) {
        e.preventDefault();
        $( '#addWorkForm' ).toggleClass( 'hidden' );
    }

    $( function(){

        // Display edit Form
        $( '.adminToolBar__link--edit' ).on( "click", function( e ){
            titleTemplate = $( "<input class='editForm__input editForm__input--title' autocomplete='off' type='text' name='title'/>" ),
                descriptionTemplate = $( "<textarea class='editForm__input editForm__input--description' rows='5' name='description'/>" );

            e.preventDefault();

            setTarget( e );

            $title = $( '#' + $target + ' .work__title' );
            $description = $( '#' + $target + ' .work__description' );
            sTitle = $title.html();
            $.ajax({
                url: window.location.origin + "/get/work/" + $target,
                method: "GET",
                success: function( r ) {
                    sDescription = r;
                    descriptionTemplate.val( $( '<div/>' ).html( sDescription).text() );
                    $description.replaceWith( descriptionTemplate );
                }
            });

            $( this ).hide();
            $( '#' + $target + ' .adminToolBar__link--save' ).show();
            $( '#' + $target + ' .adminToolBar__link--abort' ).show();

            titleTemplate.val( sTitle );
            $title.replaceWith( titleTemplate );

        } );

        // Send Data
        $( '.adminToolBar__link--save' ).on( "click", function( e ){
            e.preventDefault();
            $( this ).hide();
            $( '#' + $target + ' .adminToolBar__link--edit' ).show();
            $( '#' + $target + ' .adminToolBar__link--abort' ).hide();

            var data = "title=" + $( '.editForm__input--title' ).val() + "&description=" + $( '.editForm__input--description' ).val();
            $.ajax({
                url: window.location.origin + "/edit/work/" + $target,
                method: "POST",
                data: data,
                beforeSend: function (xhr) {
                    xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                },
                success: function(r) {
                    alertBox( "success", "Réalisation mise à jour !" );

                    window.setTimeout( function() {
                        window.location.reload();
                    }, 1500 );
                }
            });

            reset( e , false);
        } );

        // Delete Work
        $( '.adminToolBar__link--delete' ).on( "click", function( e ){
            e.preventDefault();
            setTarget( e );
            swal(
                {
                    title: "Are you sure?",
                    text: "You will not be able to recover this work !",
                    type: "error",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes, delete it !",
                    cancelButtonText: "No, abort please!",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function( isConfirm ) {
                    if ( isConfirm ) {
                        // Do delete with AJAX
                        $.ajax({
                            url: "delete/work/" + $target
                        });
                        $( '#' + $target).slideUp();
                        swal("Deleted!", "Your imaginary file has been deleted.", "success");
                    } else {
                        swal("Aborted", "Your work is safe :)");
                    }
                }
            );

        } );

        // Abort editing
        $( '.adminToolBar__link--abort' ).on( "click", function( e ){
            reset( e, true );
        } );

        // Display Add Work form
        $( '#addWork').on( "click", function( e ){
           closeOrShowAdminForm( e );
        } );

        // Display Add Work form
        $( '#closeAdminForm').on( "click", function( e ){
           closeOrShowAdminForm( e );
        } );

        // Remove alert
        $( '.alert').on( "click", function( e ){
            e.preventDefault();

            $( this).slideUp();
        } );

    } );

} )()