var Main = new Vue({
  el: '#app',
  data: {
    wXh: 8,
    campos: [],
    indexClick: [null, null],
    posAnterior: [null, null],
    posAtual: [],
    owner: null,
    clicks: 0,
    active: 0,
    pontosJogador1: 0,
    pontosJogador2: 0,
    winner: null,
    userId: null,
    userName: null,
    guest: false,
    existsPlayer2: false,
    status: 0,
    winner_id: null,
    jg1: 'img/img.png',
    jg2: 'img/img2.png',
    jg1d: 'img/dama.png',
    jg2d: 'img/dama2.png',
    jogador: this.jg1,
    exists: false,
  },
  methods: {
    getIndex(i, j) {
      this.indexClick = [i, j];
      if ((this.jogador == this.jg1 && this.owner) || (this.jogador == this.jg2 && !this.owner)) {
        if (!this.won() && this.existsPlayer2 && !this.guest && (this.isPossible(i, j) || this.clicks == 1)) {
          if (this.owner && this.jogador == this.jg1) {
            this.clicks ++;
            this.main();
            this.refresh();
          } else if (!this.owner && this.jogador == this.jg2) {
            this.clicks ++;
            this.main();
            this.refresh();
          } else {
            this.clicks = 0;
            this.refresh();
          }
        } else if (!this.isPossible(i, j)) {
          this.clicks = 0;
          this.remover();
        }
      } else {
        this.clicks = 0;
        this.remover();
      }
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

      if (this.clicks == 1) {
        console.log("KK");
        if ((this.campos[i][j] == this.jg1 || this.campos[i][j] == this.jg1d) && this.owner) {
          this.firstClick(i, j);
        } else if ((this.campos[i][j] == this.jg2 || this.campos[i][j] == this.jg2d) && !this.owner) {
          this.firstClick(i, j);
        } else {
          this.clicks = 0;
          this.remover();
        }
      }

      if (this.clicks == 2) {
        console.log('KKkk');
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
                      this.pontosJogador1 ++;
                      this.changePlayer();
                    } else {
                      this.mover(i, j, iA, jA, this.jg1);
                      this.campos[iA -1][jA -1] = "img/fundo.png";
                      this.isPossible_doubleJump(i, j, this.jg1, this.jg2);
                      this.pontosJogador1 ++;
                      this.changePlayer();
                    }
                    this.remover();
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
                      this.pontosJogador1 ++;
                      this.changePlayer();
                    } else {
                      this.mover(i, j, iA, jA, this.jg1);
                      this.campos[iA -1][jA +1] = "img/fundo.png";
                      this.isPossible_doubleJump(i, j, this.jg1, this.jg2);
                      this.pontosJogador1 ++;
                      this.changePlayer();
                    }
                    this.remover();
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
                    this.pontosJogador1 ++;
                    this.changePlayer();
                    this.remover();
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
                    this.pontosJogador1 ++;
                    this.changePlayer();
                    this.remover();
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
                    this.pontosJogador1 ++;
                    this.changePlayer();
                    this.remover();
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
                    this.pontosJogador1 ++;
                    this.changePlayer();
                    this.remover();
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
                      this.pontosJogador2 ++;
                      this.changePlayer();
                    } else {
                      this.mover(i, j, iA, jA, this.jg2);
                      this.campos[iA +1][jA -1] = "img/fundo.png";
                      this.isPossible_doubleJump(i, j, this.jg2, this.jg1);
                      this.pontosJogador2 ++;
                      this.changePlayer();
                    }
                    this.remover();
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
                      this.pontosJogador2 ++;
                      this.changePlayer();
                    } else {
                      this.mover(i, j, iA, jA, this.jg2);
                      this.campos[iA +1][jA +1] = "img/fundo.png";
                      this.isPossible_doubleJump(i, j, this.jg2, this.jg1);
                      this.pontosJogador2 ++;
                      this.changePlayer();
                    }
                    this.remover();
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
                    this.pontosJogador2 ++;
                    this.changePlayer();
                    this.remover();
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
                    this.pontosJogador2 ++;
                    this.changePlayer();
                    this.remover();
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
                    this.pontosJogador2 ++;
                    this.changePlayer();
                    this.remover();
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
                    this.pontosJogador2 ++;
                    this.changePlayer();
                    this.remover();
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
        } else if (this.campos[iA][jA] == this.jogador || this.campos[iA][jA] == this.jg1d || this.campos[iA][jA] == this.jg2d) {
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
      let stacks = 0;
      if (i >= 0 && i <= this.campos.length -1 && j >= 0 && j <= this.campos.length -1) {
        if (this.campos[i][j] == j1) {
          if ((i-2 >= 0 && j-2 >= 0)
            && (this.campos[i -1][j -1] == j2
            || this.campos[i -1][j -1] == inimigoD)
            && this.campos[i -2][j -2] == "img/fundo.png") {
            this.campos[i -2][j -2] = "img/fundoP.png";
            stacks ++;
          }
          if ((i-2 >= 0 && j+2 <= this.campos.length -1)
            && (this.campos[i -1][j +1] == j2
            || this.campos[i -1][j +1] == inimigoD)
            && this.campos[i -2][j +2] == "img/fundo.png") {
            this.campos[i -2][j +2] = "img/fundoP.png";
            stacks ++;
          }
          if ((i-1 >= 0 && j-1 >= 0)
            && this.campos[i -1][j -1] == "img/fundo.png") {
            this.campos[i -1][j -1] = "img/fundoP.png";
            stacks ++;
          }
          if ((i-1 >= 0 && j+1 <= this.campos.length -1)
            && this.campos[i -1][j +1] == "img/fundo.png") {
            this.campos[i -1][j +1] = "img/fundoP.png";
            stacks ++;
          }
          if (stacks > 0) return true;
          else return false;
        } else {
          this.clicks = 0;
          this.remover();
        }
      }
    },
    isPossible_down(i, j, j1, j2) {
      var inimigoD = this.changeOpponent(j1);
      let stacks = 0;
      if (i >= 0 && i <= this.campos.length -1 && j >= 0 && j <= this.campos.length -1) {
        if (this.campos[i][j] == j1) {
          if ((i+2 <= this.campos.length -1 && j-2 >= 0)
            && (this.campos[i +1][j -1] == j2
            || this.campos[i +1][j -1] == inimigoD)
            && this.campos[i +2][j -2] == "img/fundo.png") {
            this.campos[i +2][j -2] = "img/fundoP.png";
            stacks ++;
          }
          if ((i+2 <= this.campos.length -1 && j+2 <= this.campos.length -1)
            && (this.campos[i +1][j +1] == j2
            || this.campos[i +1][j +1] == inimigoD)
            && this.campos[i +2][j +2] == "img/fundo.png") {
            this.campos[i +2][j +2] = "img/fundoP.png";
            stacks ++;
          }
          if ((i+1 <= this.campos.length -1 && j-1 >= 0)
            && this.campos[i +1][j -1] == "img/fundo.png") {
            this.campos[i +1][j -1] = "img/fundoP.png";
            stacks ++;
          }
          if ((i+1 <= this.campos.length -1 && j+1 <= this.campos.length -1)
            && this.campos[i +1][j +1] == "img/fundo.png") {
            this.campos[i +1][j +1] = "img/fundoP.png";
            stacks ++;
          }
          if (stacks > 0) return true;
          else return false;
        } else {
          this.clicks = 0;
          this.remover();
        }
      }
    },
    isPossible(i, j) {
      if (i <= this.campos.length -1 && j <= this.campos.length -1) {
        if (this.jogador == this.jg1) {
          if (this.campos[i][j] == this.jg1d) {
            if (this.isPossible_down(i, j, this.jg1d, this.jg2) ||
              this.isPossible_up(i, j, this.jg1d, this.jg2)) {
              return true;
            } else {
              return false;
            }
          } else if (this.campos[i][j] == this.jg1) {
            if (this.isPossible_up(i, j, this.jg1, this.jg2)) {
              return true;
            } else {
              return false;
            }
          }
        }
        if (this.jogador == this.jg2) {
          if (this.campos[i][j] == this.jg2d) {
            if (this.isPossible_up(i, j, this.jg2d, this.jg1) ||
              this.isPossible_down(i, j, this.jg2d, this.jg1)) {
              return true;
            } else {
              return false;
            }
          } else if (this.campos[i][j] == this.jg2) {
            if (this.isPossible_down(i, j, this.jg2, this.jg1)) {
              return true;
            } else {
              return false;
            }
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
            else if ((i+2 <= this.campos.length -1 && j+2 <= this.campos.length -1)
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
            else if ((i-2 >= 0 && j+2 <= this.campos.length -1)
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
          else if ((i-2 >= 0 && j-2 >= 0)
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
          else if ((i+2 <= this.campos.length -1 && j-2 >= 0)
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
          else if ((i+2 <= this.campos.length -1 && j+2 <= this.campos.length -1)
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
      if (this.clicks == 1 && i <= this.campos.length -1 && j <= this.campos.length -1) {
        if (this.jogador != this.campos[i][j]
          && this.jg1d != this.campos[i][j]
          && this.jg2d != this.campos[i][j]
          && "img/fundoP.png" != this.campos[i][j]) {
          this.clicks = 0;
        } else if (this.isPossible(i, j)) {
          this.isPossible(i, j);
        }
      }
    },
    mover(i, j, iA, jA, piece) {
      this.campos[iA][jA] = "img/fundo.png";
      this.campos[i][j] = piece;
      this.clicks = 0;
      this.refresh();
    },
    empate() {
      console.log("empate");
      var d1 = 0;
      var d2 = 0;
      var p1 = 0;
      var p2 = 0;
      if (this.pontosJogador1 == 10 || this.pontosJogador2 == 10) {
        for (var i = 0; i < this.campos.length; i++) {
          for (var j = 0; j < this.campos[i].length; j++) {
            var x = this.wXh == 8 ? 11 : 19;
            var player = this.pontosJogador1 == x ? 1 : 2;
            if (this.campos[i][j] == this.jg1d) {
              d1 ++;
            }
            if (this.campos[i][j] == this.jg2d) {
              d2 ++;
            }
            if (player == 1) {
              if (this.campos[i][j] == this.jg1) {
                p1 ++;
                if (!this.isPossible(i, j)) {
                  this.winner = this.jogador;
                  console.log("Venceu: ", this.jogador);
                  break;
                }
              }
            }
            if (player == 2) {
              if (this.campos[i][j] == this.jg2) {
                p2 ++;
                if (!this.isPossible(i, j)) {
                  console.log("Venceu: ", this.jogador);
                  this.winner = this.jogador;
                  break;
                }
              }
            }
          }
        }
        if ((d1 == 2 && d2 == 2) && (p1 == 0 && p2 == 0)) {
          //2 damas contra 2 damas
          this.winner = -1;
        } else if (((d1 == 2 && d2 == 1) && (p1 == 0 && p2 == 0)) || ((d1 == 1 && d2 == 2) && (p1 == 0 && p2 == 0))) {
          //2 damas contra 1 dama
          this.winner = -1;
        } else if ((d1 == 2 && d2 == 1 && p2 == 1 && p1 == 0) || (d2 == 2 && d1 == 1 && p1 == 1 && p2 == 0)) {
          //2 damas contra 1 dama e 1 pedra
          this.winner = -1;
        }
      }
    },
    changePlayer() {
      this.empate();
      if (this.jogador == this.jg1) {
        this.jogador = this.jg2;
      } else {
        this.jogador = this.jg1;
      }
      this.won();
      this.update(0);
      this.refresh();
    },
    refresh() {
      this.campos.push([]);
      this.campos.splice(this.campos.length-1, 1);
    },
    update(empate) {
      this.remover();
      console.log(empate);
      const me = this;
      $.ajax({
        url: "../backend/insertInto.php",
        method: "POST",
        dataType: "json",
        data: {
          board: JSON.stringify(this.campos),
          turn: this.jogador,
          player1_points: this.pontosJogador1,
          player2_points: this.pontosJogador2,
          winner_id: this.winner_id,
          winner: this.winner,
          userName: this.userName,
          active: this.active,
          empate: empate,
        },
        success(data) {
        },
        error(args) {
          console.error(args);
        },
      });
    },
    ping() {
      const me = this;
      if (this.winner == null) {
        $.ajax({
          url: "../backend/getData.php",
          method: "GET",
          dataType: "json",
          success(data) {
            if (me.clicks == 0) {
              me.campos = JSON.parse(data[0][2]);
              me.jogador = data[0][3];
              me.pontosJogador1 = data[0][8];
              me.pontosJogador2 = data[0][9];
              me.winner_id = data[0][11];
              me.winner = data[0][12];
              me.active = data[0][10];
              me.refresh();
              if (me.userId == data[0][6]) {
                me.owner = true;
              } else if (me.userId == data[0][7]) {
                me.owner = false;
              } if (data[0][7] != null) {
                me.existsPlayer2 = true;
              } else if (data[0][7] == null) {
                me.starts();
              }
            }
            setTimeout(function () { me.ping(); }, 200);
          },
          error(args) {
            console.error(args);
          },
        });
      }
    },
    getUserId() {
      const me = this;
      $.ajax({
        url: "../backend/getUserId.php",
        method: "GET",
        dataType: "json",
        success(data) {
          me.userId = data[0];
          me.userName = data[1];
        },
        error(args) {
          console.error(args);
        },
      });
    },
    starts() {
      const me = this;
      $.ajax({
        url: "../backend/loadTable.php",
        method: "GET",
        dataType: "json",
        success(data) {
          me.exists = true;
          me.campos = JSON.parse(data[0][2]);
          me.jogador = data[0][3];
          me.winner_id = data[0][11];
          me.wXh = data[0][4];
          if (data[0][6] != null && data[0][7] != null) {
            if (data[0][6] != me.userId && data[0][7] != me.userId) {
              me.guest = true;
            }
          }
          me.refresh();
        },
        error(args) {
          console.error(args);
          me.exists = false;
        }
      });
    },
    won() {
      var qtdPoints = 12;
      if (this.wXh == 10) {
        qtdPoints = 20;
      }
      if (this.winner == -1) {
        this.update(1);
        this.refresh();
        return true;
      } else if (this.pontosJogador1 == qtdPoints) {
        this.winner = this.jg1;
        this.winner_id = this.userId;
        this.update(0);
        this.refresh();
        return true;
      } else if (this.pontosJogador2 == qtdPoints) {
        this.winner = this.jg2;
        this.winner_id = this.userId;
        this.update(0);
        this.refresh();
        return true;
      }
      this.refresh();
      return false;
    }
  },
  created() {
    this.getUserId();
    this.starts();
    this.ping();
  },
});
