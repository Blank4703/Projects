package uk.ac.aston.oop.javafx.assessed;

import javafx.fxml.FXML;
import javafx.scene.control.CheckBox;
import javafx.scene.control.Slider;
import javafx.scene.control.TextArea;
import javafx.scene.control.TextField;
import uk.ac.aston.oop.javafx.assessed.model.Database;
import uk.ac.aston.oop.javafx.assessed.model.Video;

public class CreateVideoController {
    @FXML private TextField titleText;
    @FXML private TextField directorText;
    @FXML private Slider playTime;
    @FXML private CheckBox ownBox;
    @FXML private TextArea commentText;

    private final Database vid;

    public CreateVideoController(Database vid){
        this.vid = vid;
    }

    @FXML
    public void createPressed(){
        final Video video = new Video(titleText.getText(), directorText.getText(), (int)playTime.getValue());
        video.setComment(commentText.getText());
        if (ownBox.isSelected()){
            video.setOwn(true);
        }
        vid.addItem(video);
        titleText.getScene().getWindow().hide();
    }
    @FXML
    public void cancelPressed(){
        titleText.getScene().getWindow().hide();
    }
}
