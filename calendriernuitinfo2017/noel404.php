<head>
    <title>
        SAUVER LE PAPA NOEL
    </title>
    <style>
        body {
            position: relative;
            animation-name: couleur;
            animation-duration: 2s;
            animation-iteration-count: infinite;
        }
        
        @keyframes papa {
        0% {top: 10vh; left : 0;}
        25% {top: 10vh; left : 80vw;}
        50% {top: 80vh; left : 80vw;}
        75% {top: 80vh; left : 0;}
        100% {top: 10vh; left : 0;}
    }
    
    @keyframes couleur {
    0%   {background-color: rgba(255, 255, 255, .1); color: rgba(0, 0, 0, 1);}
    25%  {background-color: rgba(255, 0, 0, .1); color: rgba(0, 255, 255, 1);}
    50%  {background-color: rgba(0, 255, 0, .1); color: rgba(255, 0, 255, 1);}
    75%  {background-color: rgba(0, 0, 255, .1); color: rgba(255, 255, 0, 1);}
    100% {background-color: rgba(255, 255, 255, .1); color: rgba(0, 0, 0, 1);}
}
    #logonoel {
        position: absolute;
        animation-name: papa;
        animation-duration: 10s;
        animation-iteration-count: infinite;
    }
    
    h1 {
        text-align: center;
    }
    </style>
</head>
<body>
    <h1>Cliquez sur le père noel pour le sauver</h1>
    <a id="logonoel" href="gagne.php"><img src="img/logoNoel.png" alt="papa nono"></a>
    <audio src="audio/popcorn.mp3" autoplay></audio>
</body>