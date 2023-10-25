<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class Application extends Model {

    protected $fillable = array(

    );

    public static $rules = array(

    );

    /**
     * The database table used by the model
     *
     * @var string
     */
    protected $table = 'applications';

    public function isValid($data) {
        $validation = Validator::make($data, static::$rules);

        if ($validation->passes())
            return true;

        $this->errors = $validation->messages();

        return false;
    }

    public static function generateCode() {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array();
        $alphaLength = strlen($alphabet) - 1;
        for ($i = 0; $i < 32; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass);
    }

    public static function moreThoughts($pros, $cons, $lifeHacks) {
        $section = '<a href="#more-thoughts" class="btn btn-default btn-tooltip" data-toggle="modal" data-target="#more-thoughts-modal">More Thoughts</a>
                    <div class="more-thoughts">
                        <div class="pros-statement">
                            ' . $pros . '
                        </div>
                        <div class="cons-statement">
                            ' . $cons . '
                        </div>
                        <div class="life-hack-statement">
                            ' . $lifeHacks . '
                        </div>
                    </div>'
        ;

        return $section;
    }

    public static function moreThoughtsToolTip($questionData) {
        $section = '<button type="button" class="btn btn-default btn-tooltip tooltipster ' . (array_key_exists('position',$questionData) ? $questionData['position'] : 'bottom') .  ' tooltipstered" data-tooltip-content="#tooltip_content-' . $questionData['tag'] . '">
                        More Thoughts
                    </button>
                    <div class="tooltip_templates">
                        <div id="tooltip_content-' . $questionData['tag'] . '">
                            <h3 class="mb30">' . (array_key_exists('ct',$questionData) ? $questionData['ct'] . '. ' : '') . $questionData['question'] . '</h3>
                            <div class="more-thoughts">
                                <div class="pros-statement mb15">
                                    <h4 class="mb5"><u>Pros</u></h4>
                                    ' . (($questionData['pros'] != '') ? $questionData['pros'] : 'N/A') . '
                                </div>
                                <div class="cons-statement mb15">
                                    <h4 class="mb5"><u>Cons</u></h4>
                                    ' . (($questionData['cons'] != '') ? $questionData['cons'] : 'N/A') . '
                                </div>
                                <div class="life-hack-statement mb15">
                                    <h4 class="mb5"><u>Life Hack</u></h4>
                                    ' . (($questionData['life-hacks'] != '') ? $questionData['life-hacks'] : 'N/A') . '
                                </div>
                            </div>
                        </div>
                    </div>
        '
        ;

        return $section;
    }

    public static function yesNoQuestion($ct, $sectionId, $class, $title, $isDraft = false, $leftAt = '', $answer = '') {
        $section = '<section id="' . $sectionId . '" class="' . $class . ' ' . (($isDraft && $sectionId == $leftAt) ? 'active' : '') . '">
                    <div class="container">
                        <input type="hidden" name="' . $sectionId . '" value="' . $answer . '" />
                        <h2>' . $ct . '. ' . $title .'?</h2>
                        <div class="row">
                            <div class="col-md-4 col-md-offset-2 col-sm-6">
                                <div class="property-img yes-no">
                                    <img src="' . asset('/images/homedreambuilder/application/placeholder/yes.png') . '" alt="' . $title . ' - Yes"/>
                                    <!--<h3>Yes</h3>-->
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="property-img yes-no">
                                    <img src="' . asset('/images/homedreambuilder/application/placeholder/no.png') . '" alt="' . $title . ' - No"/>
                                    <!--<h3>No</h3>-->
                                </div>
                            </div>
                        </div>'
        ;

        if ($isDraft)
            $saveDraftBtn = '<input type="submit" name="save-again" class="btn btn-grey save" value="Save as Draft">';
        else
            $saveDraftBtn = '<a href="#save-draft" class="btn btn-grey save" data-toggle="modal" data-target="#save-draft-modal">Save as Draft</a>';

        $section = $section . '<div class="row mt60"><div class="col-md-12 text-center">' . $saveDraftBtn . '</div></div>';

        $section = $section . '</div></section>';

        return $section;
    }

    public static function formTableValue($ct, $sectionId, $title, $answer = '', $top10FeaturesTag = array(), $noAnswerForNewQuestion = false) {
        $enableEditing = false;

        return '<tr ' . (($answer == 'No' || $answer == '') ? 'style="display: none"' : '') . '>' .
            (($enableEditing) ? '<td class="edit-cell">' . (($answer != '' || $noAnswerForNewQuestion) ? '<a href="#' . $sectionId . '" class="edit" id="edit-' . $sectionId . '">Edit</a>' : '') . '</td>' : '') .
            '<td>' . $ct . '. ' . $title . '</td>
                    <td id="td-' . $sectionId . '">' . $answer . '</td>
                    <td><input type="checkbox"
                                name="cb-feature"
                                data-value="' . $sectionId . '"
                                value="' . $title . '"
                                class="top-10-checkbox '
            . (($answer == '') ? 'no-answer' : '') . '" '
            . ((in_array($sectionId, $top10FeaturesTag)) ? 'checked=checked' : '')
            . (($answer == '' || (count($top10FeaturesTag) == 10 && !in_array($sectionId, $top10FeaturesTag))) ? 'disabled' : '') . '/>'
            . ((in_array($sectionId, $top10FeaturesTag)) ? '<span class="ft-600" style="margin-left:10px">' . ((in_array($sectionId, $top10FeaturesTag)) ? 10 - array_search($sectionId, $top10FeaturesTag) : '') . '</span>' : '')
            . '</td></tr>';
    }

//    public static function formTableValue($ct, $sectionId, $title, $answer = '', $top10Features = array(), $noAnswerForNewQuestion = false) {
//        $enableEditing = false;
//
//        return '<tr ' . (($answer == 'No' || $answer == '') ? 'style="display: none"' : '') . '>' .
//                    (($enableEditing) ? '<td class="edit-cell">' . (($answer != '' || $noAnswerForNewQuestion) ? '<a href="#' . $sectionId . '" class="edit" id="edit-' . $sectionId . '">Edit</a>' : '') . '</td>' : '') .
//                    '<td>' . $ct . '. ' . $title . '</td>
//                    <td id="td-' . $sectionId . '">' . $answer . '</td>
//                    <td><input type="checkbox"
//                                name="cb-feature"
//                                data-value="' . $sectionId . '"
//                                value="' . $title . '"
//                                class="top-10-checkbox '
//            . (($answer == '') ? 'no-answer' : '') . '" '
//            . ((in_array($title, $top10Features)) ? 'checked=checked' : '')
//            . (($answer == '' || (count($top10Features) == 10 && !in_array($title, $top10Features))) ? 'disabled' : '') . '/>'
//            . ((in_array($title, $top10Features)) ? '<span class="ft-600" style="margin-left:10px">' . ((in_array($title, $top10Features)) ? 10 - array_search($title, $top10Features) : '') . '</span>' : '')
//            . '</td></tr>';
//    }

    public static function initializeHomeFeatures() {
        return array(
            self::homeFeatures('Asking Price', 'asking-price', ''),
            self::homeFeatures('Monthly Payment', 'monthly-payment', ''),
            self::homeFeatures('Current Amount', 'current-amount', ''),
            self::homeFeatures('Dwelling Type', 'dwelling-types', ''),
            self::homeFeatures('Dwelling Style', 'dwelling-styles', ''),
            self::homeFeatures('City', 'city', ''),
            self::homeFeatures('Zip Code', 'zipcode', ''),
            self::homeFeatures('# of Bedrooms', 'num-of-bedrooms', ''),
            self::homeFeatures('# of Bathrooms', 'num-of-bathrooms', ''),
            self::homeFeatures('Approximate Square Ft. Home', 'approx-sq-ft-home', ''),
            self::homeFeatures('Lot Size Slide', 'lot-size-slide', ''),
//            self::homeFeatures('Basement', 'basement', ''),
            self::homeFeatures('# of Interior Levels', 'num-of-interior-levels', ''),
            self::homeFeatures('Year Built', 'year-built', ''),
            self::homeFeatures('Garage Spaces', 'garage-spaces', ''),
            // Parking Features
            array(
                'Sub Features Title' => 'Parking Features',
                'Sub Features' => array(
                    self::homeFeatures('Covered Parking', 'covered-parking', 'parking-features'),
                    self::homeFeatures('Direct Entry', 'direct-entry', 'parking-features'),
                    self::homeFeatures('Extended Length Garage', 'extended-length-garage', 'parking-features'),
                    self::homeFeatures('Golf Cart Garage', 'golf-cart-garage', 'parking-features'),
                    self::homeFeatures('RV Garage', 'rv-garage', 'parking-features'),
                    self::homeFeatures('Garage Cabinets', 'garage-cabinets', 'parking-features'),
                    self::homeFeatures('Shared Driveway', 'shared-driveway', 'parking-features'),
                    self::homeFeatures('Detached Garage', 'detached-garage', 'parking-features'),
                    self::homeFeatures('Electric Door Opener', 'electric-door-opener', 'parking-features'),
                    self::homeFeatures('Hangar', 'hangar', 'parking-features'),
                    self::homeFeatures('Separate Storage Area', 'separate-storage-area', 'parking-features'),
                    self::homeFeatures('Slab Parking Spaces', 'slab-parking-spaces', 'parking-features'),
                )
            ),
            // Backyard Features
            array(
                'Sub Features Title' => 'Backyard Features',
                'Sub Features' => array(
                    self::homeFeatures('Private Backyard Fence', 'private-backyard-fence', 'backyard-features'),
                    self::homeFeatures('Lots of Trees and Fruit Trees', 'tree-selection', 'backyard-features'),
                    self::homeFeatures('Dog Run', 'dog-run', 'backyard-features'),
                    self::homeFeatures('Covered Patio / Gazebo', 'covered-patio', 'backyard-features'),
                    self::homeFeatures('Guest House / Casita', 'guest-house', 'backyard-features'),
                    self::homeFeatures('Grass to mow and edge', 'grass-mow-edge', 'backyard-features'),
                    self::homeFeatures('Turf / Artificial Grass', 'grass-turf-artificial', 'backyard-features'),
                    self::homeFeatures('Desert Landscape', 'desert-landscape', 'backyard-features'),
                    self::homeFeatures('Swing Set, Sandbox', 'swing-set-sandbox', 'backyard-features'),
                    self::homeFeatures('Spa / Jacuzzi', 'spa-jacuzzi', 'backyard-features'),
                    self::homeFeatures('Firepit', 'firepit', 'backyard-features'),
                    self::homeFeatures('Built in BBQ / Pizza Over', 'built-in-bbq-pizza-oven', 'backyard-features'),
                    self::homeFeatures('Workshop', 'workshop', 'backyard-features'),
                    self::homeFeatures('Putting Green', 'putting-green', 'backyard-features'),
                )
            ),
            // Pool
            array(
                'Sub Features Title' => 'Pool',
                'Sub Features' => array(
                    self::homeFeatures('Pool', 'pool', 'pool'),
                    self::homeFeatures('Private Pool', 'private-pool', 'pool'),
                    self::homeFeatures('Community', 'community', 'pool'),
                    self::homeFeatures('Screened in Pool', 'screened-in-pool', 'pool'),
                    self::homeFeatures('Fenced Pool', 'fenced-pool', 'pool'),
                    self::homeFeatures('Lap Pool', 'lap-pool', 'pool'),
                    self::homeFeatures('Play Pool', 'play-pool', 'pool'),
                    self::homeFeatures('Diving Pool', 'diving-pool', 'pool'),
                    self::homeFeatures('Heated Pool', 'heated-pool', 'pool'),
                )
            ),
            // Specific Subdivision
            self::homeFeatures('Specific Subdivision', 'specific-subdivision', 'specific-subdivision'),
            // Architecture Type
            array(
                'Sub Features Title' => 'Architecture Type',
                'Sub Features' => array(
                    self::homeFeatures('Contemporary', 'contemporary', 'architecture-type'),
                    self::homeFeatures('Tuscan (Santa Barbara)', 'tuscan', 'architecture-type'),
                    self::homeFeatures('Territorial / Santa Fe', 'territorial', 'architecture-type'),
                    self::homeFeatures('Ranch', 'ranch', 'architecture-type'),
                    self::homeFeatures('Spanish', 'spanish', 'architecture-type'),
                    self::homeFeatures('Other', 'other', 'architecture-type'),
                    self::homeFeatures('2-3-4', 'plex-234', 'architecture-type'),
                )
            ),
            // Neighborhood
            array(
                'Sub Features Title' => 'Neighborhood',
                'Sub Features' => array(
                    self::homeFeatures('Neighborhood Walk Trail', 'neighborhood-walk-trail', 'neighborhood'),
                    self::homeFeatures('Neighborhood Park', 'neighborhood-park', 'neighborhood'),
                )
            ),
            // Interior Design
            array(
                'Sub Features Title' => 'Interior Design',
                'Sub Features' => array(
                    self::homeFeatures('Basement', 'basement', 'interior-design'),
                    self::homeFeatures('Finished Basement', 'finished-basement', 'interior-design'),
                    self::homeFeatures('Bathroom in Basement', 'bathroom-in-basement', 'interior-design'),
                    self::homeFeatures('Fireplace', 'fireplace', 'interior-design'),
                    self::homeFeatures('City Light View', 'city-light-view', 'interior-design'),
                )
            ),
            // Lot
            array(
                'Sub Features Title' => 'Lot',
                'Sub Features' => array(
                    self::homeFeatures('Cul-de-sac Lot', 'cul-de-sac-lot', 'lot'),
                    self::homeFeatures('Hillside Lot', 'hillside-lot', 'lot'),
                )
            ),
            // Exposure
            array(
                'Sub Features Title' => 'Exposure',
                'Sub Features' => array(
                    self::homeFeatures('East West exposure', 'east-west-exposure', 'exposure'),
                    self::homeFeatures('North South exposure', 'north-south-exposure', 'exposure'),
                )
            ),
            // Exterior Area
            array(
                'Sub Features Title' => 'Exterior Area',
                'Sub Features' => array(
                    self::homeFeatures('Waterfront Lot', 'waterfront-lot', 'exterior-area'),
                    self::homeFeatures('Alley', 'alley', 'exterior-area'),
                    self::homeFeatures('Corner Lot', 'corner-lot', 'exterior-area'),
                    self::homeFeatures('Borders common area', 'borders-common-area', 'exterior-area'),
                    self::homeFeatures('Golf Course Lot', 'golf-course-lot', 'exterior-area'),
                    self::homeFeatures('Mountain View', 'mountain-view', 'exterior-area'),
                )
            ),
            // Flooring
            array(
                'Sub Features Title' => 'Flooring',
                'Sub Features' => array(
                    self::homeFeatures('Carpet Flooring', 'carpet-flooring', 'flooring'),
                    self::homeFeatures('Laminate Flooring', 'laminate-flooring', 'flooring'),
                    self::homeFeatures('Stone Flooring', 'stone-flooring', 'flooring'),
                    self::homeFeatures('Wood Flooring', 'wood-flooring', 'flooring'),
                    self::homeFeatures('Concrete Flooring', 'concrete-flooring', 'flooring'),
                    self::homeFeatures('Tile Flooring', 'tile-flooring', 'flooring'),
                    self::homeFeatures('Vinyl Flooring', 'vinyl-flooring', 'flooring'),
                )
            ),
            // Kitchen Features
            array(
                'Sub Features Title' => 'Kitchen Features',
                'Sub Features' => array(
                    self::homeFeatures('Cook Top', 'cook-top', 'kitchen-features'),
                    self::homeFeatures('Gas Stove', 'gas-stove', 'kitchen-features'),
                    self::homeFeatures('Trash Compactor', 'trash-compactor', 'kitchen-features'),
                    self::homeFeatures('Wine Refrigerator', 'wine-refrigerator', 'kitchen-features'),
                    self::homeFeatures('Pantry', 'pantry', 'kitchen-features'),
                    self::homeFeatures('Granite Countertops', 'granite-countertops', 'kitchen-features'),
                    self::homeFeatures('Island', 'island', 'kitchen-features'),
                    self::homeFeatures('Built-in Microwave', 'built-in-microwave', 'kitchen-features'),
                )
            ),
            // Extra Rooms
            array(
                'Sub Features Title' => 'Extra Rooms',
                'Sub Features' => array(
                    self::homeFeatures('Media / Theatre Room', 'media-theatre-room', 'extra-rooms'),
                    self::homeFeatures('Laundry Room', 'laundry-room', 'extra-rooms'),
                    self::homeFeatures('Game Room', 'game-room', 'extra-rooms'),
                    self::homeFeatures('Workout Room', 'workout-room', 'extra-rooms'),
                    self::homeFeatures('Sun Room', 'sun-room', 'extra-rooms'),
                )
            ),
            // Master Bedroom
            array(
                'Sub Features Title' => 'Master Bedroom',
                'Sub Features' => array(
                    self::homeFeatures('Split Floorplan', 'split-floorplan', 'master-bedroom'),
                    self::homeFeatures('Upstairs', 'upstairs', 'master-bedroom'),
                    self::homeFeatures('Downstairs', 'downstairs', 'master-bedroom'),
                )
            ),
            // Master Bathroom
            array(
                'Sub Features Title' => 'Master Bathroom',
                'Sub Features' => array(
                    self::homeFeatures('Separate Tub Shower', 'separate-tub-shower', 'master-bathroom'),
                    self::homeFeatures('Jacuzzi Tub', 'jacuzzi-tub', 'master-bathroom'),
                    self::homeFeatures('Bidet', 'bidet', 'master-bathroom'),
                    self::homeFeatures('Double Sinks', 'double-sinks', 'master-bathroom'),
                    self::homeFeatures('Private Toilet Room', 'private-toilet-room', 'master-bathroom')
                )
            ),
        );
    }

    public static function homeFeatures($title, $sectionId, $class, $pros = '', $cons = '', $alts = '') {
        return array(
            'Title' => $title,
            'Section ID' => $sectionId,
            'Class' => $class,
            'Pros' => ($pros == '') ? 'N/A' : $pros,
            'Cons' => ($cons == '') ? 'N/A' : $cons,
            'Alternatives' => ($alts == '') ? 'N/A' : $alts
        );
    }

    public static function numOfHomeFeatures() {
        $homeFeaturesList = Application::initializeHomeFeatures();
        $count = 0;

        foreach ($homeFeaturesList as $homeFeature) {
            if (array_key_exists('Sub Features', $homeFeature)) {
                foreach ($homeFeature['Sub Features'] as $homeFeatureSubValue) {
                    $count++;
                }
            }
            else {
                $count++;
            }
        }

        return $count;
    }
}
