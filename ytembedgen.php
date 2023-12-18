<?php
  include "_ulo.php";
    ?>
<div class="w3-container w3-card-4 w3-light-grey w3-text-blue w3-margin" >
    <h2>YouTube Embedded Link Generator</h2>
     <div class="w3-panel w3-pale-pink w3-bottombar w3-border-pink w3-border">
  <p><strong>Note:</strong> Pagkatapos mo ma embed ang YT video link mo i Copy mo yan kase yan ang gagamitin mo sa <i>Share Video Panel</i> Click mo  <a href="#">Dito</a>  para ma share mo na </p>
</div>
    <div class="w3-row w3-section">
  <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-link"></i></div>
    <div class="w3-rest">
      <input class="w3-input w3-border" name="description" type="text" id="youtubeUrl"  placeholder="Enter Your YouTube Video Url" required>
    </div>
</div>
    
   
    <button class="w3-input w3-border" onclick="generateEmbeddedLink()">Generate Embedded Link</button>
    <br>
    <p color="blue"> Your Embedded Link will Generate here:</p>
    <textarea id="embeddedLink" ></textarea>
</div>
    <script>
        function generateEmbeddedLink() {
            const youtubeUrl = document.getElementById('youtubeUrl').value;
            const videoId = youtubeUrl.match(/v=([^&]+)/)[1];
            const embedUrl = `https://www.youtube.com/embed/${videoId}`;

            const embeddedLinkElement = document.getElementById('embeddedLink');
            embeddedLinkElement.textContent = `${embedUrl}`;
        }
    </script>
<?php
  include "_tiil.php";
    ?>