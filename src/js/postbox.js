function change_postbox (a) {

  if (a == "video") {
    var video1 = `<div class="form-group">
                    <label for="textpost_textarea" class="sr-only">Eingabefeld für YouTube-Link</label>
                    <input type="text" class="form-control" name="YouTube-Link" id="postbox_link" placeholder="YouTube-Link">
                    <input type="hidden" name="post-category" value="video">
                  </div>
                  <div class="form-group">
                    <label for="textpost_textarea" class="sr-only">Eingabefeld für Text zum YouTube-Video</label>
                    <textarea class="form-control" name="Posttext" id="textpost_textarea" placeholder="Schreibe etwas dazu..."></textarea>
                  </div>`;

    var video2 = `<div class="form-group">
                    <label for="textpost_textarea" class="sr-only">Eingabefeld für YouTube-Link</label>
                    <input type="text" class="form-control" name="YouTube-Link-mobile" id="postbox_link_mobile" placeholder="YouTube-Link">
                    <input type="hidden" name="post-category" value="video">
                  </div>
                  <div class="form-group">
                    <label for="textpost_textarea" class="sr-only">Eingabefeld für Text zum YouTube-Video</label>
                    <textarea class="form-control" name="Posttext-mobile" id="textpost_textarea_mobile" placeholder="Schreibe etwas dazu..."></textarea>
                  </div>`;

    var video3 = `<button class="btn btn-default select_post_content_buttons" id="post_box_text_button" onclick="change_postbox('text');"><i class="fa fa-align-left fa-lg" aria-hidden="true"></i></button>
                  <button class="btn btn-default select_post_content_buttons" id="post_box_photo_button" onclick="change_postbox('photo');"><i class="fa fa-camera-retro fa-lg" aria-hidden="true"></i></button>
                  <button class="btn btn-default select_post_content_buttons" id="post_box_link_button" onclick="change_postbox('link');"><i class="fa fa-link fa-lg" aria-hidden="true"></i></button>`;

    document.getElementById('textpost_textarea_container').innerHTML = video1;
    document.getElementById('textpost_textarea_container_mobile').innerHTML = video2;
    document.getElementById('postbox_buttons_container').innerHTML = video3;
    document.getElementById('postbox_buttons_container_mobile').innerHTML = video3;

  } else if (a == "photo") {
    var photo1 = `<div class="form-group">
                    <label for="textpost_textarea" class="sr-only">Eingabefeld für Foto-Link</label>
                    <input class="pull-left" type="file" name="Foto-Link" id="postbox_link" placeholder="Foto-Link">
                    <input type="hidden" name="post-category" value="image">
                  </div>
                  <div class="form-group">
                    <label for="textpost_textarea" class="sr-only">Eingabefeld für Text zum Foto</label>
                    <textarea class="form-control" name="Posttext" id="textpost_textarea" placeholder="Schreibe etwas dazu..."></textarea>
                  </div>`;

    var photo2 = `<div class="form-group">
                    <label for="textpost_textarea" class="sr-only">Eingabefeld für Foto-Link</label>
                    <input class="pull-left" type="file" name="Foto-Link-mobile" id="postbox_link_mobile" placeholder="Foto-Link">
                    <input type="hidden" name="post-category" value="image">
                  </div>
                  <div class="form-group">
                    <label for="textpost_textarea" class="sr-only">Eingabefeld für Text zum Foto</label>
                    <textarea class="form-control" name="Posttext-mobile" id="textpost_textarea_mobile" placeholder="Schreibe etwas dazu..."></textarea>
                  </div>`;

    var photo3 = `<button class="btn btn-default select_post_content_buttons" id="post_box_text_button" onclick="change_postbox('text');"><i class="fa fa-align-left fa-lg" aria-hidden="true"></i></button>
                  <button class="btn btn-default select_post_content_buttons" id="post_box_video_button" onclick="change_postbox('video');"><i class="fa fa-youtube fa-lg" aria-hidden="true"></i></button>
                  <button class="btn btn-default select_post_content_buttons" id="post_box_link_button" onclick="change_postbox('link');"><i class="fa fa-link fa-lg" aria-hidden="true"></i></button>`;

    document.getElementById('textpost_textarea_container').innerHTML = photo1;
    document.getElementById('textpost_textarea_container_mobile').innerHTML = photo2;
    document.getElementById('postbox_buttons_container').innerHTML = photo3;
    document.getElementById('postbox_buttons_container_mobile').innerHTML = photo3;

    } else if (a == "link") {
      var link1 = `<div class="form-group">
                      <label for="textpost_textarea" class="sr-only">Eingabefeld für Link</label>
                      <input type="text" class="form-control" name="Link" id="postbox_link" placeholder="Link">
                      <input type="hidden" name="post-category" value="link">
                    </div>
                    <div class="form-group">
                      <label for="textpost_textarea" class="sr-only">Eingabefeld für Text zum Link</label>
                      <textarea class="form-control" name="Posttext" id="textpost_textarea" placeholder="Schreibe etwas dazu..."></textarea>
                    </div>`;

      var link2 = `<div class="form-group">
                      <label for="textpost_textarea" class="sr-only">Eingabefeld für Link</label>
                      <input type="text" class="form-control" name="Link-mobile" id="postbox_link_mobile" placeholder="Link">
                      <input type="hidden" name="post-category" value="link">
                    </div>
                    <div class="form-group">
                      <label for="textpost_textarea" class="sr-only">Eingabefeld für Text zum Link</label>
                      <textarea class="form-control" name="Posttext-mobile" id="textpost_textarea_mobile" placeholder="Schreibe etwas dazu..."></textarea>
                    </div>`;

      var link3 = ` <button class="btn btn-default select_post_content_buttons" id="post_box_text_button" onclick="change_postbox('text');"><i class="fa fa-align-left fa-lg" aria-hidden="true"></i></button>
                    <button class="btn btn-default select_post_content_buttons" id="post_box_video_button" onclick="change_postbox('video');"><i class="fa fa-youtube fa-lg" aria-hidden="true"></i></button>
                    <button class="btn btn-default select_post_content_buttons" id="post_box_photo_button" onclick="change_postbox('photo');"><i class="fa fa-camera-retro fa-lg" aria-hidden="true"></i></button>`;

      document.getElementById('textpost_textarea_container').innerHTML = link1;
      document.getElementById('textpost_textarea_container_mobile').innerHTML = link2;
      document.getElementById('postbox_buttons_container').innerHTML = link3;
      document.getElementById('postbox_buttons_container_mobile').innerHTML = link3;

    } else {
      var text1 = `<div class="form-group">
                      <label for="textpost_textarea" class="sr-only">Eingabefeld für Posttext</label>
                      <textarea class="form-control" name="Posttext" id="textpost_textarea" placeholder="Schreibe etwas..."></textarea>
                      <input type="hidden" name="post-category" value="text">
                    </div>`;

      var text2 = `<div class="form-group">
                      <label for="textpost_textarea" class="sr-only">Eingabefeld für Posttext</label>
                      <textarea class="form-control" name="Posttext-mobile" id="textpost_textarea_mobile" placeholder="Schreibe etwas..."></textarea>
                      <input type="hidden" name="post-category" value="text">
                    </div>`;

      var text3 = ` <button class="btn btn-default select_post_content_buttons" id="post_box_video_button" onclick="change_postbox('video');"><i class="fa fa-youtube fa-lg" aria-hidden="true"></i></button>
                    <button class="btn btn-default select_post_content_buttons" id="post_box_photo_button" onclick="change_postbox('photo');"><i class="fa fa-camera-retro fa-lg" aria-hidden="true"></i></button>
                    <button class="btn btn-default select_post_content_buttons" id="post_box_link_button" onclick="change_postbox('link');"><i class="fa fa-link fa-lg" aria-hidden="true"></i></button>`;

      document.getElementById('textpost_textarea_container').innerHTML = text1;
      document.getElementById('textpost_textarea_container_mobile').innerHTML = text2;
      document.getElementById('postbox_buttons_container').innerHTML = text3;
      document.getElementById('postbox_buttons_container_mobile').innerHTML = text3;

      }
}
