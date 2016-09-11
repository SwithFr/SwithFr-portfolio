( function(){

    "use strict";

    var redColor = "#da3433",
        radius = 25,
        bIsClicked = false,
        code = "3636a4169ed98a5cb1a961ef872877e532596604";

    var App = {
        "canvas" : null,
        "ctx": null,
        "width"  : null,
        "height" : null,
        "aDots" : [],
        "code" : null
    };

    var _isCanvasSupported = function( $canvasElt ) {
        return !!$canvasElt.getContext;
    };

    App.setup = function() {

        this.code = "";

        this.canvas = document.querySelector( '#canvas' );

        if( !_isCanvasSupported( this.canvas ) ) {
            return console.error( "Canvas isn't supported !" );
        }

        this.ctx = this.canvas.getContext( '2d' );
        this.width = this.canvas.width;
        this.height = this.canvas.height;

        var x = 100,
            y = 100,
            i = 1;

        for( i; i <= 9; i++ ) {
            this.aDots.push( new oDot( x, y, radius, i ) );
            x += 150;
            ( x > 400 ) && ( x = 100);
            ( i % 3 == 0 ) && ( y += 150 );
        }

        this.render();
    };

    App.render = function() {
        this.aDots.forEach( function( e ){
            e.render();
        } );
    }

    App.checkCollision = function ( evt ) {
        var rect = this.canvas.getBoundingClientRect(),
            iXposition = evt.clientX - rect.left,
            iYposition = evt.clientY - rect.top;

        this.aDots.forEach( function( elt ){
            var iDeltaX = Math.abs( iXposition - elt.x ),
                iDeltaY = Math.abs( iYposition - elt.y ),
                iDistance = Math.sqrt( ( Math.pow( iDeltaX, 2 ) + Math.pow( iDeltaY, 2 ) ), 2 );
            if ( iDistance < elt.r ) {
                ( elt.color != "green" ) && ( this.code += elt.v );
                elt.color = "green";
                this.update();
            }
        }, this );
    }

    App.update = function(){
        this.ctx.clearRect( 0, 0, this.width, this.height );

        this.render();
    }

    App.win = function() {
        document.querySelector( '.hidden').classList.remove( 'hidden' );
        this.canvas.classList.add( 'hidden' );
    }

    var oDot = function( x, y, r, v){
        this.x = x;
        this.y = y;
        this.r = r;
        this.v = v;
        this.color = redColor;
    };

    oDot.prototype.render = function () {
        var ctx = App.ctx;

        ctx.beginPath();
        ctx.fillStyle = this.color;
        ctx.arc( this.x, this.y, this.r, 0, Math.PI * 2, true );
        ctx.fill();
        ctx.closePath();
    };


    App.setup();

    App.canvas.addEventListener( "mousedown", function( e ){
        bIsClicked = true;
    }, false );

    App.canvas.addEventListener( "mouseup", function( e ){
        bIsClicked = false;
        var sCode = Sha1.hash(App.code);
        if ( sCode == code) {
            App.win();
        } else {
            App.setup();
        }

    }, false );

    App.canvas.addEventListener( "mousemove", function( e ){
        if( bIsClicked ) {
            App.checkCollision( e );
        }
    }, false );

} )()