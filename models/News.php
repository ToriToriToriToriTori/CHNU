<?php

class News {
    public $id;
    public $name;
    public $description;
    public $photo;
    
    public function __construct($id, $name, $description, $photo) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->photo = $photo;
    }
}

$news = array(
    new News(1, 'Breaking News', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', './sourse/kelly-sikkema-7alo7OJVNVw-unsplash.jpg'),
    new News(2, 'Local News', 'Nulla facilisi. Fusce vel justo nec massa efficitur sodales.', './sourse/power-station-374097_1920.jpg'),
    new News(3, 'World News', 'Vestibulum euismod nisl euismod magna lacinia, in pellentesque urna ullamcorper.', './sourse/thunder-4963719_1920.jpg'),
    new News(1, 'Breaking News', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', './sourse/kelly-sikkema-7alo7OJVNVw-unsplash.jpg'),
    new News(2, 'Local News', 'Nulla facilisi. Fusce vel justo nec massa efficitur sodales.', './sourse/power-station-374097_1920.jpg'),
    new News(3, 'World News', 'Vestibulum euismod nisl euismod magna lacinia, in pellentesque urna ullamcorper.', './sourse/thunder-4963719_1920.jpg'),
    new News(1, 'Breaking News', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', './sourse/kelly-sikkema-7alo7OJVNVw-unsplash.jpg'),
    new News(2, 'Local News', 'Nulla facilisi. Fusce vel justo nec massa efficitur sodales.', './sourse/power-station-374097_1920.jpg'),
    new News(3, 'World News', 'Vestibulum euismod nisl euismod magna lacinia, in pellentesque urna ullamcorper.', './sourse/thunder-4963719_1920.jpg')

);