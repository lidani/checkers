var Main = new Vue({
  el: '#app',
  data: {
    wXh: 8,
    campos: [],
    indexClick: [null, null],
    posAnterior: [null, null],
    posAtual: [],
    clicks: 0,
    pontosJogador1: 0,
    pontosJogador2: 0,
    vencedor: null,
    jogador: 'img/img.png',
    jg1: 'img/img.png',
    jg2: 'img/img2.png',
    jg1d: 'img/dama.png',
    jg2d: 'img/dama2.png',
  },
  methods: {
    geraTab: function () {
      for (var i = 0; i < this.wXh; i++) {
        var list = [];
        for (var j = 0; j < this.wXh; j++) {
          list.push("img/fundo.png");
        }
        this.campos.push(list);
      }
      for (var i = 0; i < this.campos.length; i++) {
        for (var j = 0; j < this.campos[i].length; j++) {
          if (this.campos.length == 10) {
            if (i == this.campos.length -4) {
              if (j % 2 != 0) {
                this.campos[i][j] = this.jg1;
              }
            }
            if (i == 3) {
              if (j % 2 == 0) {
                this.campos[i][j] = this.jg2;
              }
            }
          }
          if (i == 1) {
            if (j % 2 == 0) {
              this.campos[i][j] = this.jg2;
            }
          } else if (i == 0 || i == 2) {
            if (j % 2 != 0){
              this.campos[i][j] = this.jg2;
            }
          } else if (i == this.campos.length -2) {
            if (j % 2 != 0) {
              this.campos[i][j] = this.jg1;
            }
          } else if (i == this.campos.length -1 || i == this.campos.length -3) {
            if (j % 2 == 0) {
              this.campos[i][j] = this.jg1;
            }
          }
        }
      }
    },
    getIndex(i, j) {
      this.indexClick = [i, j];
      this.clicks ++;
      this.main();
    },
    main() {
      this.posAnterior[0] = this.posAtual[0];
      this.posAnterior[1] = this.posAtual[1];
      this.posAtual[0] = this.indexClick[0];
      this.posAtual[1] = this.indexClick[1];

      var i = this.posAtual[0];
      var j = this.posAtual[1];
      var iA = this.posAnterior[0];
      var jA = this.posAnterior[1];

      this.firstClick(i, j);

      if (this.clicks == 2 && !this.won()) {
        if (this.campos[i][j] == "img/fundoP.png") {
          //Player 1
          if (this.jogador == this.jg1) {
            //Normal piece
            if (this.campos[iA][jA] == this.jg1) {
              //Move one row up
              if (i == iA -1 && i != 0){
                this.mover(i, j, iA, jA, this.jg1);
                this.changePlayer();
                this.remover();
              }
              //Move two rows up (eat)
              if (i == iA -2){
                //Left column
                if (j == jA -2){
                  if (this.campos[iA -1][jA -1] == this.jg2
                    || this.campos[iA -1][jA -1] == this.jg2d) {
                    //row == 0, change to queen piece
                    if (i == 0) {
                      this.mover(i, j, iA, jA, this.jg1d);
                      this.campos[iA -1][jA -1] = "img/fundo.png";
                      this.isPossible_doubleJump(i, j, this.jg1d, this.jg2);
                      this.changePlayer();
                    } else {
                      this.mover(i, j, iA, jA, this.jg1);
                      this.campos[iA -1][jA -1] = "img/fundo.png";
                      this.isPossible_doubleJump(i, j, this.jg1, this.jg2);
                      this.changePlayer();
                    }
                    this.remover();
                    this.pontosJogador1 ++;
                  }
                }
                //Right column
                if (j == jA +2){
                  if (this.campos[iA -1][jA + 1] == this.jg2
                    || this.campos[iA -1][jA + 1] == this.jg2d) {
                    //row == 0, change to queen piece
                    if (i == 0) {
                      this.mover(i, j, iA, jA, this.jg1d);
                      this.campos[iA -1][jA +1] = "img/fundo.png";
                      this.isPossible_doubleJump(i, j, this.jg1d, this.jg2);
                      this.changePlayer();
                    } else {
                      this.mover(i, j, iA, jA, this.jg1);
                      this.campos[iA -1][jA +1] = "img/fundo.png";
                      this.isPossible_doubleJump(i, j, this.jg1, this.jg2);
                      this.changePlayer();
                    }
                    this.remover();
                    this.pontosJogador1 ++;
                  }
                }
              }
              //row == 0, change to queen piece
              else if (i == 0){
                this.mover(i, j, iA, jA, this.jg1d);
                this.changePlayer();
                this.remover();
              }
            }
            //Queen piece
            else if (this.campos[iA][jA] == this.jg1d) {
              //Move one row up/down
              if (i == iA +1 || i == iA -1){
                this.mover(i, j, iA, jA, this.jg1d);
                this.changePlayer();
                this.remover();
              }
              //Move two rows up (eat)
              else if (i == iA -2){
                if (j == jA -2){
                  if (this.campos[iA -1][jA -1] == this.jg2
                    || this.campos[iA -1][jA -1] == this.jg2d){
                    this.mover(i, j, iA, jA, this.jg1d);
                    this.campos[iA -1][jA -1] = "img/fundo.png";
                    //If the selected piece equals to queen
                    if (i == 0 || i == this.campos.length -1) {
                      this.isPossible_doubleJump(i, j, this.jg1d, this.jg2, this.jg1d);
                    }
                    this.isPossible_doubleJump(i, j, this.jg1d, this.jg2);
                    this.changePlayer();
                    this.remover();
                    this.pontosJogador1 ++;
                  }
                }
                else if (j == jA +2){
                  if (this.campos[iA -1][jA + 1] == this.jg2
                    || this.campos[iA -1][jA + 1] == this.jg2d){
                    this.mover(i, j, iA, jA, this.jg1d);
                    this.campos[iA -1][jA +1] = "img/fundo.png";
                    //If the selected piece equals to queen
                    if (i == 0 || i == this.campos.length-1) {
                      this.isPossible_doubleJump(i, j, this.jg1d, this.jg2, this.jg1d);
                    }
                    this.isPossible_doubleJump(i, j, this.jg1d, this.jg2);
                    this.changePlayer();
                    this.remover();
                    this.pontosJogador1 ++;
                  }
                }
              }
              //Move two rows down (eat)
              else if (i == iA +2){
                //Left column
                if (j == jA -2){
                  if (this.campos[iA +1][jA -1] == this.jg2
                    || this.campos[iA +1][jA -1] == this.jg2d){
                    this.mover(i, j, iA, jA, this.jg1d);
                    this.campos[iA +1][jA -1] = "img/fundo.png";
                    if (i == 0 || i == this.campos.length -1){
                      this.isPossible_doubleJump(i, j, this.jg1d, this.jg2, this.jg1d);
                    }
                    this.isPossible_doubleJump(i, j, this.jg1d, this.jg2);
                    this.changePlayer();
                    this.remover();
                    this.pontosJogador1 ++;
                  }
                }
                //Right column
                else if (j == jA +2){
                  if (this.campos[iA +1][jA + 1] == this.jg2
                    || this.campos[iA +1][jA + 1] == this.jg2d){
                    this.mover(i, j, iA, jA, this.jg1d);
                    this.campos[iA +1][jA +1] = "img/fundo.png";
                    if (i == 0 || i == this.campos.length -1) {
                      this.isPossible_doubleJump(i, j, this.jg1d, this.jg2, this.jg1d);
                    }
                    this.isPossible_doubleJump(i, j, this.jg1d, this.jg2);
                    this.changePlayer();
                    this.remover();
                    this.pontosJogador1 ++;
                  }
                }
              } else {
                this.clicks = 0;
                this.remover();
              }
            } else {
              this.clicks = 0;
              this.remover();
            }
          }
          // Player 2
          else if (this.jogador == this.jg2) {
            //Normal piece
            if (this.campos[iA][jA] == this.jg2) {
              //Move one row
              if (i == iA +1 && i != 7) {
                this.mover(i, j, iA, jA, this.jg2);
                this.changePlayer();
                this.remover();
              }
              //Move two rows down (eat)
              if (i == iA +2){
                //Left column
                if (j == jA -2){
                  if (this.campos[iA +1][jA -1] == this.jg1
                    || this.campos[iA +1][jA -1] == this.jg1d){
                    if (i == this.campos.length -1){
                      this.mover(i, j, iA, jA, this.jg2d);
                      this.campos[iA +1][jA -1] = "img/fundo.png";
                      this.isPossible_doubleJump(i, j, this.jg2d, this.jg2);
                      this.changePlayer();
                    } else {
                      this.mover(i, j, iA, jA, this.jg2);
                      this.campos[iA +1][jA -1] = "img/fundo.png";
                      this.isPossible_doubleJump(i, j, this.jg2, this.jg1);
                      this.changePlayer();
                    }
                    this.remover();
                    this.pontosJogador2 ++;
                  }
                }
                //Right column
                if (j == jA +2){
                  if (this.campos[iA +1][jA + 1] == this.jg1
                    || this.campos[iA +1][jA +1] == this.jg1d){
                    if (i == this.campos.length -1){
                      this.mover(i, j, iA, jA, this.jg2d);
                      this.campos[iA +1][jA +1] = "img/fundo.png";
                      this.isPossible_doubleJump(i, j, this.jg2d, this.jg2);
                      this.changePlayer();
                    } else {
                      this.mover(i, j, iA, jA, this.jg2);
                      this.campos[iA +1][jA +1] = "img/fundo.png";
                      this.isPossible_doubleJump(i, j, this.jg2, this.jg1);
                      this.changePlayer();
                    }
                    this.remover();
                    this.pontosJogador2 ++;
                  }
                }
              }
              //Last position of this.campos, change to Queen piece
              else if (i == this.campos.length -1){
                this.mover(i, j, iA, jA, this.jg2d);
                this.changePlayer();
                this.remover();
              }
            }
            //Queen piece
            else if (this.campos[iA][jA] == this.jg2d) {
              //Move one row
              if (i == iA +1 || i == iA -1){
                this.mover(i, j, iA, jA, this.jg2d);
                this.changePlayer();
                this.remover();
              }
              //Move two rows up (eat)
              else if (i == iA -2) {
                //Left column
                if (j == jA -2) {
                  if (this.campos[iA -1][jA -1] == this.jg1
                    || this.campos[iA -1][jA -1] == this.jg1d) {
                    this.mover(i, j, iA, jA, this.jg2d);
                    this.campos[iA -1][jA -1] = "img/fundo.png";
                    if (i == 0 || i == this.campos.length -1) {
                      this.isPossible_doubleJump(i, j, this.jg2d, this.jg1, this.jg2d);
                    }
                    this.isPossible_doubleJump(i, j, this.jg2d, this.jg1);
                    this.changePlayer();
                    this.remover();
                    this.pontosJogador2 ++;
                  }
                }
                //Right column
                else if (j == jA +2){
                  if (this.campos[iA -1][jA + 1] == this.jg1
                    || this.campos[iA -1][jA + 1] == this.jg1d){
                    this.mover(i, j, iA, jA, this.jg2d);
                    this.campos[iA -1][jA +1] = "img/fundo.png";
                    if (i == 0 || i == this.campos.length -1) {
                      this.isPossible_doubleJump(i, j, this.jg2d, this.jg1, this.jg2d);
                    }
                    this.isPossible_doubleJump(i, j, this.jg2d, this.jg1);
                    this.changePlayer();
                    this.remover();
                    this.pontosJogador2 ++;
                  }
                }
              }
              //move two rows down (eat)
              else if (i == iA +2) {
                //Left column
                if (j == jA -2) {
                  if (this.campos[iA +1][jA -1] == this.jg1
                    || this.campos[iA +1][jA -1] == this.jg1d) {
                    this.mover(i, j, iA, jA, this.jg2d);
                    this.campos[iA +1][jA -1] = "img/fundo.png";
                    if (i == 0 || i == this.campos.length -1) {
                      this.isPossible_doubleJump(i, j, this.jg2d, this.jg1, this.jg2d);
                    }
                    this.isPossible_doubleJump(i, j, this.jg2d, this.jg1);
                    this.changePlayer();
                    this.remover();
                    this.pontosJogador2 ++;
                  }
                }
                //Right column
                else if (j == jA +2) {
                  if (this.campos[iA +1][jA + 1] == this.jg1
                    || this.campos[iA +1][jA + 1] == this.jg1d) {
                    this.mover(i, j, iA, jA, this.jg2d);
                    this.campos[iA +1][jA +1] = "img/fundo.png";
                    if (i == 0 || i == this.campos.length -1) {
                      this.isPossible_doubleJump(i, j, this.jg2d, this.jg1, this.jg2d);
                    }
                    this.isPossible_doubleJump(i, j, this.jg2d, this.jg1);
                    this.changePlayer();
                    this.remover();
                    this.pontosJogador2 ++;
                  }
                }
              } else {
                this.clicks = 0;
                this.remover();
              }
            } else {
              this.clicks = 0;
              this.remover();
            }
          }
        } else if (iA == i && jA == j) {
          this.clicks = 0;
          this.remover();
        } else if (this.campos[iA][jA] == this.jogador) {
          this.clicks = 1;
          this.remover();
          this.firstClick(i, j);
        } else if (this.campos[iA][jA] == this.jg1d || this.campos[iA][jA] == this.jg2d) {
          this.clicks = 1;
          this.remover();
          this.firstClick(i, j);
        } else {
          this.clicks = 0;
          this.remover();
        }
      }
    },
    remover(){
      for (var i = 0; i < this.campos.length; i++) {
        for (var j = 0; j < this.campos[i].length; j++) {
          if (this.campos[i][j] == "img/fundoP.png"){
            this.campos[i][j] = "img/fundo.png";
          }
        }
      }
    },
    changeOpponent(j){
      var inimigoD;
      if (j == this.jg1) inimigoD = this.jg2d;
      else if (j == this.jg2) inimigoD = this.jg1d;
      else if (j == this.jg1d) inimigoD = this.jg2d;
      else if (j == this.jg2d) inimigoD = this.jg1d;
      return inimigoD;
    },
    isPossible_up(i, j, j1, j2) {
      var inimigoD = this.changeOpponent(j1);
      if (i >= 0 && i <= this.campos.length -1 && j >= 0 && j <= this.campos.length -1) {
        if (this.campos[i][j] == j1) {
          if ((i-2 >= 0 && j-2 >= 0)
            && (this.campos[i -1][j -1] == j2
            || this.campos[i -1][j -1] == inimigoD)
            && this.campos[i -2][j -2] == "img/fundo.png") {
            this.campos[i -2][j -2] = "img/fundoP.png";
          }
          if ((i-2 >= 0 && j+2 <= this.campos.length -1)
            && (this.campos[i -1][j +1] == j2
            || this.campos[i -1][j +1] == inimigoD)
            && this.campos[i -2][j +2] == "img/fundo.png") {
            this.campos[i -2][j +2] = "img/fundoP.png";
          }
          if ((i-1 >= 0 && j-1 >= 0)
            && this.campos[i -1][j -1] == "img/fundo.png") {
            this.campos[i -1][j -1] = "img/fundoP.png";
          }
          if ((i-1 >= 0 && j+1 <= this.campos.length -1)
            && this.campos[i -1][j +1] == "img/fundo.png") {
            this.campos[i -1][j +1] = "img/fundoP.png";
          }
        } else {
          this.clicks = 0;
          this.remover();
        }
        return false;
      }
    },
    isPossible_down(i, j, j1, j2) {
      var inimigoD = this.changeOpponent(j1);
      if (i >= 0 && i <= this.campos.length -1 && j >= 0 && j <= this.campos.length -1) {
        if (this.campos[i][j] == j1) {
          if ((i+2 <= this.campos.length -1 && j-2 >= 0)
            && (this.campos[i +1][j -1] == j2
            || this.campos[i +1][j -1] == inimigoD)
            && this.campos[i +2][j -2] == "img/fundo.png") {
            this.campos[i +2][j -2] = "img/fundoP.png";
          }
          if ((i+2 <= this.campos.length -1 && j+2 <= this.campos.length -1)
            && (this.campos[i +1][j +1] == j2
            || this.campos[i +1][j +1] == inimigoD)
            && this.campos[i +2][j +2] == "img/fundo.png") {
            this.campos[i +2][j +2] = "img/fundoP.png";
          }
          if ((i+1 <= this.campos.length -1 && j-1 >= 0)
            && this.campos[i +1][j -1] == "img/fundo.png") {
            this.campos[i +1][j -1] = "img/fundoP.png";
          }
          if ((i+1 <= this.campos.length -1 && j+1 <= this.campos.length -1)
            && this.campos[i +1][j +1] == "img/fundo.png") {
            this.campos[i +1][j +1] = "img/fundoP.png";
          }
        } else {
          this.clicks = 0;
          this.remover();
        }
        return false;
      }
    },
    isPossible(i, j) {
      if (i <= this.campos.length -1 && j <= this.campos.length -1) {
        if (this.jogador == this.jg1) {
          if (this.campos[i][j] == this.jg1d) {
            this.isPossible_down(i, j, this.jg1d, this.jg2);
            this.isPossible_up(i, j, this.jg1d, this.jg2);
          } else {
            this.isPossible_up(i, j, this.jg1, this.jg2);
          }
        }
        if (this.jogador == this.jg2) {
          if (this.campos[i][j] == this.jg2d) {
            this.isPossible_up(i, j, this.jg2d, this.jg1);
            this.isPossible_down(i, j, this.jg2d, this.jg1);
          } else {
            this.isPossible_down(i, j, this.jg2, this.jg1);
          }
        }
      }
    },
    do_DoubleJump(i, j, j1, j2) {
      var inimigoD = this.changeOpponent(j1);
      var j1d;
      if (j1 == this.jg1) j1d = this.jg1d;
      else if (j1 == this.jg2) j1d = this.jg2d;

      if (i >= 0 && i <= this.campos.length -1 && j >= 0 && j <= this.campos.length -1) {
        if (this.campos[i][j] == j1
          && (j1 == this.jg1 || j1 == this.jg2)) {
          if (this.jogador == this.jg2) {
            if ((i+2 <= this.campos.length -1 && j-2 >= 0)
              && (this.campos[i +1][j -1] == j2
              || this.campos[i +1][j -1] == inimigoD)
              && this.campos[i +2][j -2] == "img/fundo.png") {
              this.campos[i +1][j -1] = "img/fundo.png";
              if (i+2 == this.campos.length -1) {
                this.campos[i +2][j -2] = j1d;
                this.campos[i][j] = "img/fundo.png";
                this.pontosJogador2 ++;
                this.remover();
                this.do_DoubleJump(i+2, j-2, j1d, j2);
              } else {
                this.campos[i +2][j -2] = j1;
                this.campos[i][j] = "img/fundo.png";
                this.pontosJogador2 ++;
                this.remover();
                this.do_DoubleJump(i+2, j-2, j1, j2);
              }
            }
            if ((i+2 <= this.campos.length -1 && j+2 <= this.campos.length -1)
              && (this.campos[i +1][j +1] == j2
              || this.campos[i +1][j +1] == inimigoD)
              && this.campos[i +2][j +2] == "img/fundo.png") {
              this.campos[i +1][j +1] = "img/fundo.png";
              if (i +2 == 7) {
                this.campos[i +2][j +2] = j1d;
                this.campos[i][j] = "img/fundo.png";
                this.pontosJogador2 ++;
                this.remover();
                this.do_DoubleJump(i+2, j+2, j1d, j2);
              } else {
                this.campos[i +2][j +2] = j1;
                this.campos[i][j] = "img/fundo.png";
                this.pontosJogador2 ++;
                this.remover();
                this.do_DoubleJump(i+2, j+2, j1, j2);
              }
            }
          }
          else if (this.jogador == this.jg1) {
            if ((i-2 >= 0 && j-2 >= 0)
              && (this.campos[i -1][j -1] == j2
              || this.campos[i -1][j -1] == inimigoD)
              && this.campos[i -2][j -2] == "img/fundo.png") {
              this.campos[i -1][j -1] = "img/fundo.png";
              if (i -2 == 0) {
                this.campos[i -2][j -2] = j1d;
                this.campos[i][j] = "img/fundo.png";
                this.pontosJogador1 ++;
                this.remover();
                this.do_DoubleJump(i-2, j-2, j1d, j2);
              } else {
                this.campos[i -2][j -2] = j1;
                this.campos[i][j] = "img/fundo.png";
                this.pontosJogador1 ++;
                this.remover();
                this.do_DoubleJump(i-2, j-2, j1, j2);
              }
            }
            if ((i-2 >= 0 && j+2 <= this.campos.length -1)
              && (this.campos[i -1][j +1] == j2
              || this.campos[i -1][j +1] == inimigoD)
              && this.campos[i -2][j +2] == "img/fundo.png") {
              this.campos[i -1][j +1] = "img/fundo.png";
              if (i -2 == 0) {
                this.campos[i -2][j +2] = j1d;
                this.campos[i][j] = "img/fundo.png";
                this.pontosJogador1 ++;
                this.remover();
                this.do_DoubleJump(i-2, j+2, j1d, j2);
              } else {
                this.campos[i -2][j +2] = j1;
                this.campos[i][j] = "img/fundo.png";
                this.pontosJogador1 ++;
                this.remover();
                this.do_DoubleJump(i-2, j+2, j1, j2);
              }
            }
          }
        }
        else if (this.campos[i][j] == j1 &&
          (j1 == this.jg1d || j1 == this.jg2d)) {
          if ((i-2 >= 0 && j+2 <= this.campos.length -1)
            && (this.campos[i -1][j +1] == j2
            || this.campos[i -1][j +1] == inimigoD)
            && this.campos[i -2][j +2] == "img/fundo.png") {
            this.campos[i -1][j +1] = "img/fundo.png";
            this.campos[i -2][j +2] = j1;
            this.campos[i][j] = "img/fundo.png";
            if (j1 == this.jg2d) this.pontosJogador2 ++;
            else this.pontosJogador1 ++;
            this.remover();
            this.do_DoubleJump(i-2, j+2, j1, j2);
          }
          if ((i-2 >= 0 && j-2 >= 0)
            && (this.campos[i -1][j -1] == j2
            || this.campos[i -1][j -1] == inimigoD)
            && this.campos[i -2][j -2] == "img/fundo.png") {
            this.campos[i -1][j -1] = "img/fundo.png";
            this.campos[i -2][j -2] = j1;
            this.campos[i][j] = "img/fundo.png";
            if (j1 == this.jg2d) this.pontosJogador2 ++;
            else this.pontosJogador1 ++;
            this.remover();
            this.do_DoubleJump(i-2, j-2, j1, j2);
          }
          if ((i+2 <= this.campos.length -1 && j-2 >= 0)
            && (this.campos[i +1][j -1] == j2
            || this.campos[i +1][j -1] == inimigoD)
            && this.campos[i +2][j -2] == "img/fundo.png") {
            this.campos[i +1][j -1] = "img/fundo.png";
            this.campos[i +2][j -2] = j1;
            this.campos[i][j] = "img/fundo.png";
            if (j1 == this.jg2d) this.pontosJogador2 ++;
            else this.pontosJogador1 ++;
            this.remover();
            this.do_DoubleJump(i+2, j-2, j1, j2);
          }
          if ((i+2 <= this.campos.length -1 && j+2 <= this.campos.length -1)
            && (this.campos[i +1][j +1] == j2
            || this.campos[i +1][j +1] == inimigoD)
            && this.campos[i +2][j +2] == "img/fundo.png") {
            this.campos[i +1][j +1] = "img/fundo.png";
            this.campos[i +2][j +2] = j1;
            this.campos[i][j] = "img/fundo.png";
            if (j1 == this.jg2d) this.pontosJogador2 ++;
            else this.pontosJogador1 ++;
            this.remover();
            this.do_DoubleJump(i+2, j+2, j1, j2);
          }
        }
      }
    },
    isPossible_doubleJump(i, j, d) {
      if (i <= this.campos.length -1 && j <= this.campos.length -1){
        if (this.jogador == this.jg1) {
          this.remover();
          this.do_DoubleJump(i, j, this.jg1, this.jg2);
        }
        if (this.jogador == this.jg2) {
          this.remover();
          this.do_DoubleJump(i, j, this.jg2, this.jg1);
        }
        if (this.jogador == this.jg1 && d == this.jg1d) {
          this.remover();
          this.do_DoubleJump(i, j, this.jg1d, this.jg2);
        }
        if (this.jogador == this.jg2 && d == this.jg2d) {
          this.remover();
          this.do_DoubleJump(i, j, this.jg2d, this.jg1);
        }
      }
    },
    firstClick(i, j) {
      if (this.clicks == 1 && i <= this.campos.length -1 && j <= this.campos.length -1){
        if (this.jogador != this.campos[i][j]
          && this.jg1d != this.campos[i][j]
          && this.jg2d != this.campos[i][j]
          && "img/fundoP.png" != this.campos[i][j]){
          this.clicks = 0;
        } else {
          this.isPossible(i, j);
        }
      }
    },
    mover(i, j, iA, jA, piece) {
      this.campos[iA][jA] = "img/fundo.png";
      this.campos[i][j] = piece;
      this.clicks = 0;
    },
    changePlayer(){
      if (this.jogador == this.jg1) {
        this.jogador = this.jg2;
        $(".tabuleiro").css({"border" : "5px solid blue"});
      } else {
        this.jogador = this.jg1;
        $(".tabuleiro").css({"border": "5px solid red"});
      }
    },
    won() {
      var qtdPoints = 12;
      if (this.wXh == 10) {
        qtdPoints = 20;
      }
      if (this.pontosJogador1 == qtdPoints) {
        this.vencedor = 1;
        $(".tabuleiro").css({"border": "5px solid black"});
        return true;
      } else if (this.pontosJogador2 == qtdPoints) {
        this.vencedor = 2;
        $(".tabuleiro").css({"border": "5px solid black"});
        return true;
      }
      return false;
    }
  },
  created() {
    this.geraTab();
  }
});
