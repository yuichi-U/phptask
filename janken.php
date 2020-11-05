<?php

const STONE = 0;
const SCISSERS = 1;
const PAPER = 2;

const HAND_TYPE = array(
        STONE => 'グー',
        SCISSERS => 'チョキ',
        PAPER => 'パー'
    );

const DRAW = 0;
const LOSE = 1;
const WIN = 2;

const WIN_OR_LOSE = array(
    DRAW => 'あいこ',
    LOSE => '負け',
    WIN => '勝ち'
);

const MESSAGE1 = '0から2の数字を入力して下さい';
const MESSAGE2 = '１か０を入力して下さい';

const YES = 1;
const NO = 0;

main($result);
function main(){
    echo "手を選んで下さい「0:グー」「1:チョキ」「2:パー」";
    $userhand = userInput($userhand);
    $comhand = computerOutput($comhand);
    echo "あなたは".HAND_TYPE[$userhand]."を出しました"."\n";
    echo "相手は".HAND_TYPE[$comhand]."を出しました"."\n";
    $judge = judge($userhand,$comhand);
    $result = show($judge);
    $draw = drawcheck($judge);
    echo "継続しますか？「1:継続」「0:終了」"."\n";
    $choice = continueChoice($choice);
    if($choice == true){
        return main();
    }
    elseif($choice == false){
        exit;
    }
    $con = continuation($choice);
}

function show($judge){
    echo WIN_OR_LOSE[$judge]."\n";
}

function userInput($userhand){
    $userhand = trim(fgets(STDIN));
    if (check($userhand) == false){
        return userInput($userhand);
    }
    return $userhand;
}

function continueChoice($choice){
    $choice = trim(fgets(STDIN));
    if (continueChoiceCheck($choice) == false){
        return continueChoice($choice);
    }
    return $choice;
}

function computerOutput($comhand){//相手の手をランダムに生成
    $comhand = rand(0,2);
    return $comhand;
}

function judge($userhand, $comhand){//勝敗の判定
    $judge = ($userhand - $comhand + 3) % 3;
    return $judge;
}

function drawcheck($judge){//あいこの時はmainに戻る
    if($judge == DRAW){
        return main($result);
    }
    return continuation($choice);
}

function check($userhand){//バリデーション
    if($userhand == ''){//空で入力した時
        echo "1".MESSAGE1;
        return false;
    }

    if (($userhand != STONE) && ($userhand != SCISSERS) && ($userhand != PAPER)){//3つ以外の数字を入力した時
        echo "2".MESSAGE1;
        return false;
    }

    if (is_numeric($userhand) != true){//数字以外を入力した時
        echo "3".MESSAGE1;
        return false;
    }
    return true;
}

function continueChoiceCheck($choice){//継続確認のバリデーション
    if($choice == ''){//空で入力した時
        echo "1".MESSAGE2."\n";
        return false;
    }
    if (($choice != YES) && ($choice != NO)){//1と０以外の数字を入力した時
        echo "2".MESSAGE2."\n";
        return false;
    }
    if (is_numeric($choice) != true){//数字以外を入力した時
        echo "3".MESSAGE2."\n";
        return false;
    }
    return true;
}

function continuation($choice){
    if($choice == YES){
        return true;
    }
    if($choice === NO){
        return false;
    }
}
