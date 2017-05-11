function change_postbox (a) {

  if (a == "video") {
    var video1 = `<div class="form-group">
                    <label for="textpost-textarea" class="sr-only">Enter a YouTube link</label>
                    <input type="text" class="form-control" name="YouTube-Link" id="postbox-link" placeholder="YouTube-Link">
                    <input type="hidden" name="post-category" value="video">
                  </div>
                  <div class="form-group">
                    <label for="expanding-textarea" class="sr-only">Enter text about the video</label>
                    <textarea class="form-control expanding-textarea" name="Posttext" id="expanding-textarea" placeholder="Schreibe etwas dazu..."></textarea>
                  </div>`;

    var video2 = `<button class="btn btn-default select-post-content-buttons" onclick="change_postbox('text');"><i class="fa fa-align-left fa-lg" aria-hidden="true"></i></button>
                  <button class="btn btn-default select-post-content-buttons" onclick="change_postbox('image');"><i class="fa fa-camera-retro fa-lg" aria-hidden="true"></i></button>
                  <button class="btn btn-default select-post-content-buttons" onclick="change_postbox('link');"><i class="fa fa-link fa-lg" aria-hidden="true"></i></button>`;

    document.getElementById('postbox-textarea').innerHTML = video1;
    document.getElementById('postbox-button-area').innerHTML = video2;

  } else if (a == "image") {
    var image1 = `<div class="form-group">
                    <label for="postbox-image" class="sr-only">Upload an image</label>
                    <input type="file" name="Image-Link" id="postbox-image">
                    <input type="hidden" name="post-category" value="image">
                  </div>
                  <div class="form-group">
                    <label for="expanding-textarea" class="sr-only">Enter text about the image</label>
                    <textarea class="form-control expanding-textarea" name="Posttext" id="expanding-textarea" placeholder="Schreibe etwas dazu..."></textarea>
                  </div>`;

    var image2 = `<button class="btn btn-default select-post-content-buttons" onclick="change_postbox('text');"><i class="fa fa-align-left fa-lg" aria-hidden="true"></i></button>
                  <button class="btn btn-default select-post-content-buttons" onclick="change_postbox('video');"><i class="fa fa-youtube fa-lg" aria-hidden="true"></i></button>
                  <button class="btn btn-default select-post-content-buttons" onclick="change_postbox('link');"><i class="fa fa-link fa-lg" aria-hidden="true"></i></button>`;

    document.getElementById('postbox-textarea').innerHTML = image1;
    document.getElementById('postbox-button-area').innerHTML = image2;

    } else if (a == "link") {
      var link1 = `<div class="form-group">
                      <label for="postbox-link" class="sr-only">Enter a link</label>
                      <input type="text" class="form-control" name="Link" id="postbox-link" placeholder="Link">
                      <input type="hidden" name="post-category" value="link">
                    </div>
                    <div class="form-group">
                      <label for="expanding-textarea" class="sr-only">Enter text about the link</label>
                      <textarea class="form-control expanding-textarea" name="Posttext" id="expanding-textarea" placeholder="Schreibe etwas dazu..."></textarea>
                    </div>`;

      var link2 = ` <button class="btn btn-default select-post-content-buttons" onclick="change_postbox('text');"><i class="fa fa-align-left fa-lg" aria-hidden="true"></i></button>
                    <button class="btn btn-default select-post-content-buttons" onclick="change_postbox('video');"><i class="fa fa-youtube fa-lg" aria-hidden="true"></i></button>
                    <button class="btn btn-default select-post-content-buttons" onclick="change_postbox('image');"><i class="fa fa-camera-retro fa-lg" aria-hidden="true"></i></button>`;

      document.getElementById('postbox-textarea').innerHTML = link1;
      document.getElementById('postbox-button-area').innerHTML = link2;

    } else {
      var text1 = `<div class="form-group">
                    <label for="expanding-textarea" class="sr-only">Enter a text</label>
                    <textarea class="form-control expanding-textarea" name="Posttext" id="expanding-textarea" placeholder="Schreibe etwas..."></textarea>
                    <input type="hidden" name="post-category" value="text">
                    </div><!-- /.form-group -->`;

      var text2 = ` <button class="btn btn-default select-post-content-buttons" onclick="change_postbox('video');"><i class="fa fa-youtube fa-lg" aria-hidden="true"></i></button>
                    <button class="btn btn-default select-post-content-buttons" onclick="change_postbox('image');"><i class="fa fa-camera-retro fa-lg" aria-hidden="true"></i></button>
                    <button class="btn btn-default select-post-content-buttons" onclick="change_postbox('link');"><i class="fa fa-link fa-lg" aria-hidden="true"></i></button>`;

      document.getElementById('postbox-textarea').innerHTML = text1;
      document.getElementById('postbox-button-area').innerHTML = text2;

      }
}
