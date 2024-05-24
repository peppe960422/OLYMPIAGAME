
//board
let board;
let boardWidth = 750;
let boardHeight = 250;
let context;

//dino
let corrWidth = 40;
let corrHeight = 64;
let corrX = 50;
let corrY = boardHeight - corrHeight;
let corrImg;
let corrImg2;
let corrImg3;
let corrImg4;
let corrImg5;
let corrImg6;
let corrImg7;

let corridore= {
    x : corrX,
    y : corrY,
    width : corrWidth,
    height : corrHeight
}

//cactus
let ostacoliArray = [];



//physics
let velocityX = -7; 
let velocityY = 0;
let gravity = .4;

let gameOver = false;
let score = 0;
let numeroFrame = 0;
let arrayFrames = [];

window.onload = function() {
    board = document.getElementById("board");
    board.height = boardHeight;
    board.width = boardWidth;

    context = board.getContext("2d"); 

   
    corrImg = new Image();
    corrImg.src = "./Run1.png";
    arrayFrames.push(corrImg);
    corrImg2 = new Image();
    corrImg2.src= "./Run2.png";
    arrayFrames.push(corrImg2);
    corrImg3 = new Image ();
    corrImg3.src = "./Run3.png"
    arrayFrames.push(corrImg3);
    corrImg4 = new Image ();
    corrImg4.src = "./Run4.png"
    arrayFrames.push(corrImg4);
    corrImg5 = new Image ();
    corrImg5.src = "./Run5.png"
    arrayFrames.push(corrImg5);
    corrImg6 = new Image ();
    corrImg6.src = "./Run6.png"
    arrayFrames.push(corrImg6);
    corrImg7 = new Image ();
    corrImg7.src = "./Run7.png"
    arrayFrames.push(corrImg7);



    

    corrImg.onload = function() {
        context.drawImage(corrImg, corridore.x, corridore.y, corridore.width, corridore.height);
    

    }
   
      
      requestAnimationFrame(update);
      setInterval(PosizionaOstacoli, 1000);
      document.addEventListener("keydown", moveDino);
  

 
}
function PosizionaOstacoli() {

  if (gameOver) {
    return;
}

  let ostacolo = {
    x: board.width,
    y: 220,
    lunghezza: 40,
    spessore: 10,
    height : 30
  };

  let mettiostacolo = Math.random();
  if (mettiostacolo > 0.5) {
    ostacoliArray.push(ostacolo);
  }

  if (ostacoliArray.length > 3) {
    ostacoliArray.shift();
  }
}
function drawObstacles() {
  for (let i = 0; i < ostacoliArray.length; i++) {
  let ostacolo = ostacoliArray[i];
  context.fillStyle = "black";

  context.fillRect(
    ostacolo.x,
    ostacolo.y,
    (ostacolo.lunghezza * (ostacolo.x /board.width)) + 5,
    ostacolo.spessore
  );
  context.fillRect(
    ostacolo.x + (ostacolo.lunghezza * (ostacolo.x / board.width)) + 5,
    ostacolo.y,
    3,
    30
  );
  context.fillRect(ostacolo.x, ostacolo.y, 3, 30);
}
  ;
}

function update() {
    requestAnimationFrame(update);
    if (gameOver) {
        return;
    }
    context.clearRect(0, 0, board.width, board.height);
    drawObstacles();
   
    velocityY += gravity;
    corridore.y = Math.min(corridore.y + velocityY, corrY);
      if (numeroFrame >6){

        numeroFrame= 0 ;

      }
    
      let ImmagineAttuale = arrayFrames[numeroFrame];
     
      context.drawImage(ImmagineAttuale, corridore.x, corridore.y, corridore.width, corridore.height);
        
      if (score % 2 === 0){numeroFrame++;}
      if (score % 1000 === 0){velocityX -= 1;}


    
    
    
    for (let i = 0; i < ostacoliArray.length; i++) {
        let ostacolo = ostacoliArray[i];
        ostacolo.x += velocityX;
        
        if (detectCollision(corridore,ostacolo)) {
            gameOver = true;
            context.clearRect(corridore.x,corridore.y,corridore.width, corridore.height);
            corridore.y +=30
            corrImg.src = "./dead.png";
            corridore.width = 60;
            corridore.height =35;
            corrImg.onload = function() {
                context.drawImage(corrImg, corridore.x, boardHeight-corridore.height+5, corridore.width, corridore.height);
            }
        }
    }

    //score
    context.fillStyle="black";
    context.font="20px courier";
    score++;
    context.fillText(score, 5, 20);
}

function moveDino(e) {
    if (gameOver) {
      $.ajax({
        type: "GET",
        url: "Insert_Comment.php",
        data: {
            
            punkte:score
        },
        success: function(response) {
            console.log(response);
        }
    });
        return;
        
    }

    if ((e.code == "Space" || e.code == "ArrowUp") && corridore.y == corrY) {
        //jump
        velocityY = -7;
    }
    else if (e.code == "ArrowDown" && corridore.y == corrY) {
        //duck
    }

}


function detectCollision(a, b) {
    return a.x < b.x + b.lunghezza &&   //a's top left corner doesn't reach b's top right corner
           a.x + a.width > b.x &&   //a's top right corner passes b's top left corner
           a.y < b.y + b.height &&  //a's top left corner doesn't reach b's bottom left corner
           a.y + a.height > b.y;    //a's bottom left corner passes b's top left corner
}