@extends('layouts.app')

@section('content')

<div class="scroll-container">
    <img src="../images/RPG Bar Icon.png" alt="">
    <div class="overlay">
        <p>Chose a spot you like</p>
    </div>
</div>

<div class="guide-map">
    <img src="../images/Group 276.png" alt="">
    <div class="guide-map-link">
        <a href="#target-section1" class="over-lay-link1">
            <img src="../images/Cancel.png" class="over-lay-image">
        </a>
        <a href="#target-section2" class="over-lay-link2">
            <img src="../images/Cancel.png" class="over-lay-image">
        </a>
        <a href="#target-section3" class="over-lay-link3">
            <img src="../images/Cancel.png" class="over-lay-image">
        </a>
        <a href="#target-section4" class="over-lay-link4">
            <img src="../images/Cancel.png" class="over-lay-image">
        </a>
        <a href="#target-section5" class="over-lay-link5">
            <img src="../images/Cancel.png" class="over-lay-image">
        </a>
    </div>
</div>

<div class="map-content">
    <div class="wizard">
        <div class="wizard-title" id="target-section3">
            <img src="../images/mark_mappin 2.png" alt="">
            <img src="../images/character_madoshi_01_green 2.png" alt="">
            <h5>講師用マイページを充実させましょう</h5>
        </div>
        <div class="wizard-content">
            <p>
                生徒がコースの測定をするときに参考にします <br>
                自分が信用に値する人であることがわかるように書いてみましょう <br>
                プロフィール画像は、ラーナーの公開用マイページとは別の写真を設定することができます <br>
                SNSにとんでもらい、自分のことをもっと知ってファンになってもらいましょう
            </p>
        </div>
    </div>

    <div class="shield">
        <div class="shield-title" id="target-section1">
            <img src="../images/mark_mappin 2.png" alt="">
            <img src="../images/shield_kiteshield_01_blue 2.png" alt="">
            <h5>クエストを作成しましょう</h5>
        </div>
        <div class="shield-content">
            <p>
                動画とディスクリプションを入れる <br>
                チャプターに分ける <br>
                補足があれば、PDFを添付しましょう
            </p>
        </div>
    </div>

    <div class="dragon">
        <div class="dragon-title" id="target-section4">
            <img src="../images/mark_mappin 2.png" alt="">
            <img src="../images/character_monster_dragon_03_red.png" alt="" style="width: 9vw;">
            <h5>テストを作成しましょう</h5>
        </div>
        <div class="dragon-content">
            <p>
                クエストの最後に生徒がバッジを獲得するために、テストを用意します
            </p>
        </div>

        <!-- castle セクションを dragon の中に配置 -->
        <div class="castle">
            <div class="castle-gap">
                <div class="castle-title" id="target-section2">
                    <img src="../images/toride_brown_flag_yellow 1 (1).png" alt="">
                    <h5>プレイヤーがゲットするバッジを選択しましょう</h5>
                </div>
                <div class="castle-content">
                    <p>
                        プレイヤーがBossをPassするとバッジがゲットできます <br>
                        クエストにふさわしいバッジを好きに選択して、設定しましょう <br>
                        クエストに合ったものを選んでください
                    </p>
                </div>
            </div>
            <div class="badge-example">
                <p style="font-size: 1.5rem;">Example</p>
                <img src="../images/Frame 70.png" alt="badge-example">
            </div>
        </div>
    </div>

    <div class="house">
        <div class="house-title" id="target-section5">
            <img src="../images/mark_mappin 2.png" alt="">
            <img src="../images/ie.png" alt="">
            <h5>▼ダッシュボード</h5>
        </div>
        <div class="house-content">
            <ul>
                <li>レビューや生徒からの評価を確認できます</li>
                <li>どれくらいの生徒が、コースを閲覧し、そこから気になるリストに保存したのかを確認することができます</li>
                <li>数値を参考にしてコース作成の改善ができる</li>
            </ul>
        </div>
    </div>
</div>




@endsection