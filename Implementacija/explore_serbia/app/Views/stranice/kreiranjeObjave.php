<!-- by Nikola Bjelobaba 2019/0442 -->

<?php $session = session(); ?>


    <div class="kreiranjeObjave-page-content">
        
        <div id="errorDiv" style="text-align: center; color: red"><?php foreach ($greske as $greska) {echo $greska; echo "<br/>";} ?></div>
    
       <!-- <form id="mainForm" name="mainForm" style="text-align: left" method="post" action="<?php echo site_url("/Pisac/slanjeObjave"); ?>"></form>    --> 
        <div class="title-space">
            <div class="title-space-text">
                <h4>Naslov objave<span style="color: red;">*</span></h4>
            </div>
            <input type="text" size="30" id="naslovObjave" name="naslovObjave" placeholder="Naslov objave" form="mainForm">
        </div>

        <div class="region-space">
            <div class="region-space-text">
                <h4>Region<span style="color: red;">*</span></h4>
            </div>
            <p>Ako ste iz centralnih opština u Beogradu - izaberite Beograd</p>
            <select  class="tag-type-dropdown-bar" id="municiplaity" form="mainForm" name="regionObjave">
                <?php foreach ($session->get("allLoks") as $lokacija) {
                    echo "<option value=$lokacija->naziv>$lokacija->naziv</option>";
                }?>
            </select>
        </div>
        <form id="mainForm" name="mainForm" style="text-align: left" method="post" action="<?php echo site_url("/Pisac/slanjeObjave"); ?>">
            <div class="content-space">
                <div class="content-space-text">
                    <h4>Sadržaj<span style="color: red;">*</span></h4>
                </div>
                <textarea name="objavaTextArea" id="objavaTextArea" rows="10" cols="150" id="objavaTextArea"></textarea>
            </div>
        </form>>
        <div class="main-tag-space">
            <div class="main-tag-space-text">
                <h4>Glavni tag<span style="color: red;">*</span></h4>
            </div>
            
            <select class="tag-type-dropdown-bar" id="mainTagType" onchange="updateTags(-1)" form="mainForm" name="mainTagTip">
                <option>Istorijska ličnost</option>
                <option>Spomenik</option>
                <option>Crkva/manastir</option>
                <option>Tvrdjava</option>
                <option>Arheološko nalazište</option>
                <option>Park prirode</option>
            </select>
            <select class="tag-dropdown-bar" id="mainTag" onchange="updateNewTagSpace(-1)" form="mainForm" name="mainTag">
                <option>tag1</option>
                <option>tag2</option>
                <option>tag3</option>
                <option>novi tag</option>
            </select>
            <input type="text" placeholder="novi tag" id="mainNovTag" hidden="true" form="mainForm" name="noviMainTag">
        </div>

        <div class="secondary-tag-space">
            <div class="secondary-tag-space-text">
                <h4>Sekundarni tagovi</h4>
            </div>

            <div class="secondary-tag-input-space" id="secTagSpace">


                <div class="secondary-tag">
                    
                        
                        <button class="btn  button-add-tag" onclick="addTag()">Dodaj tag</button>
                     
                        <input type="textArea" id="tagSpaceIL" value="<?php foreach (session()->get("allTags")[1] as $tag) {echo $tag->naziv; echo ',';} ?>" hidden="true">
                        <input type="textArea" id="tagSpaceSP" value="<?php foreach (session()->get("allTags")[2] as $tag) {echo $tag->naziv; echo ',';} ?>" hidden="true">
                        <input type="textArea" id="tagSpaceCM" value="<?php foreach (session()->get("allTags")[3] as $tag) {echo $tag->naziv; echo ',';} ?>" hidden="true">
                        <input type="textArea" id="tagSpaceTV" value="<?php foreach (session()->get("allTags")[4] as $tag) {echo $tag->naziv; echo ',';} ?>" hidden="true">
                        <input type="textArea" id="tagSpaceAN" value="<?php foreach (session()->get("allTags")[5] as $tag) {echo $tag->naziv; echo ',';} ?>" hidden="true">
                        <input type="textArea" id="tagSpacePP" value="<?php foreach (session()->get("allTags")[6] as $tag) {echo $tag->naziv; echo ',';} ?>" hidden="true">
                </div>

            </div>

            <input id="numOftags" name="numOftags" type="number" value="0" hidden="true" form="mainForm">
        </div>

        <div class="submit-button-space">
            <button class="btn btn-primary btn-lg button-submit-objava" type="submit" form="mainForm">Okači objavu</button>
        </div>
       
        <div class="cancel-button-space">
            <form method="post" action="<?php echo site_url("/Pisac"); ?>"> 
                <button class="btn btn-secondary btn-lg button-cancel-objava" action="<?php echo site_url("/Pisac"); ?>">Odustani</button>
            </form>
        </div>
        
    </div>
    </body>
    
    <script type="text/javascript" src="/js/kreiranjeObjave.js"></script>
    
    
</html>