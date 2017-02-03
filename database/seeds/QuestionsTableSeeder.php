<?php

use Illuminate\Database\Seeder;
use App\Question;

class QuestionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Question::truncate();
		$questions = [

			/*Automotive*/
			['category_id' => '1', 'question' => 'What kind of vehicle do you have?*', 'type' => 'radio'],
			['category_id' => '1', 'question' => 'What is the make of the vehicle?*', 'type' => 'drop'],
			['category_id' => '1', 'question' => 'Which part of the vehicle do you require help with?*', 'type' => 'checkbox'],
			['category_id' => '1', 'question' => 'What type of help do you require with this vehicle?*', 'type' => 'checkbox'],
			/*Airconditioning*/
			['category_id' => '2', 'question' => 'What type of airconditioning services are you looking for?*', 'type' => 'checkbox'],

			['category_id' => '2', 'question' => 'What type of airconditioning system is it?*', 'type' => 'radio'],
			['category_id' => '2', 'question' => 'What capacity is the airconditioning system?*', 'type' => 'radio'],
			['category_id' => '2', 'question' => 'How many units of aircon need to be worked on?*', 'type' => 'radio'],
			['category_id' => '2', 'question' => 'Which facility requires airconditioning services?*', 'type' => 'checkbox'],
			['category_id' => '2', 'question' => 'What is the size of the facility (in square feet)?*', 'type' => 'radio'],

/*11*/
			/*Beauty & Styling*/
			['category_id' => '3', 'question' => 'What kind of beauty & styling specialist do you need?*', 'type' => 'checkbox'],
			['category_id' => '3', 'question' => 'What type of event do you need the beauty & styling services for?*', 'type' => 'radio'],
			['category_id' => '3', 'question' => 'What specific services are you looking for?*', 'type' => 'checkbox'],
			['category_id' => '3', 'question' => 'How many people will need these services?*', 'type' => 'radio'],
			/*Borehole drilling*/
			['category_id' => '4', 'question' => 'What type of soil comprises your ground of?*', 'type' => 'text'], /*15*/
			
			['category_id' => '4', 'question' => 'How deep would we have to drill?*', 'type' => 'checkbox'],
			/*Carpentry*/
			['category_id' => '5', 'question' => 'What kind of help do you need with Carpentry', 'type' => 'checkbox'],
			['category_id' => '5', 'question' => 'What kind of carpentry work do you need', 'type' => 'checkbox'],
			['category_id' => '5', 'question' => 'What are the specifications of the carpentry job (width / height / length)', 'type' => 'text'],
			['category_id' => '5', 'question' => 'Will you provide all necessary materials and parts', 'type' => 'radio'],

/*21*/
			/*Cleaning & Housekeeping*/
			['category_id' => '6', 'question' => 'What type of facility requires cleaning?*', 'type' => 'radio'],
			['category_id' => '6', 'question' => 'What areas of the facility do you need cleaned?*', 'type' => 'checkbox'],
			['category_id' => '6', 'question' => 'What is the size of the facility (in square feet)?*', 'type' => 'radio'],
			['category_id' => '6', 'question' => 'How often do you need the cleaning done?*', 'type' => 'radio'],
			['category_id' => '6', 'question' => 'Will you provide cleaning equipment and supplies?*', 'type' => 'radio'],
			

			
			/*Computer,Hardware & Peripherals*/
			['category_id' => '7', 'question' => 'What device(s) do you need help with?*', 'type' => 'drop'],
			['category_id' => '7', 'question' => 'What type of brand is the device?*', 'type' => 'drop'],
			['category_id' => '7', 'question' => 'What is the make and model number of the device?*', 'type' => 'text'], /*28*/
			['category_id' => '7', 'question' => 'What type of help do you require with this part of the device?*', 'type' => 'radio'],
			['category_id' => '7', 'question' => 'Which operating system is the device on?*', 'type' => 'drop'],

/*31*/			
			['category_id' => '7', 'question' => 'What kind of entity needs this service(s)?*', 'type' => 'radio'],
			/*Consumer Appliances & Gadgets*/
			['category_id' => '8', 'question' => 'What appliance(s) do you need help with?*', 'type' => 'checkbox'],
			['category_id' => '8', 'question' => 'What is the make and model number of the appliance?*', 'type' => 'text'], /*33*/
			['category_id' => '8', 'question' => 'What type of help do you require with this part of the vehicle?*', 'type' => 'checkbox'],
			/*Electrical & Wiring*/
			['category_id' => '9', 'question' => 'What kind of help do you need with Electrical & Wiring?*', 'type' => 'checkbox'],


			['category_id' => '9', 'question' => 'What fittings does the provider need to work on?*', 'type' => 'checkbox'],
			['category_id' => '9', 'question' => 'What type of facility requires electrical and wiring services?*', 'type' => 'radio'],
			['category_id' => '9', 'question' => 'Where do you want to install / repair the electrical wiring fittings?*', 'type' => 'checkbox'],
			['category_id' => '9', 'question' => 'Will you provide all necessary materials and parts?*', 'type' => 'radio'],
			/*Fencing*/
			['category_id' => '10', 'question' => 'What kind of help do you need with the fence?*', 'type' => 'checkbox'],

/*41*/
			['category_id' => '10', 'question' => 'How tall is the current fence / required height for the new fence?*', 'type' => 'radio'],
			['category_id' => '10', 'question' => 'What material is the current fence / required for the new fence?*', 'type' => 'radio'],
			['category_id' => '10', 'question' => 'What type of facility requires fencing services?*', 'type' => 'radio'],
			['category_id' => '10', 'question' => 'What is the approximate length of the current fence needing repair / required new fence?*', 'type' => 'radio'],
			['category_id' => '10', 'question' => 'Will you provide all necessary materials and parts?*', 'type' => 'radio'],


			/*Flooring & Tiling*/
			['category_id' => '11', 'question' => 'What kind of help do you need with the floor or tiles?*', 'type' => 'checkbox'],
			['category_id' => '11', 'question' => 'What material is the current floor or tiles / required for the new floor or tiles?*', 'type' => 'radio'],
			['category_id' => '11', 'question' => 'What finish is the current floor or tiles / required for the new floor or tiles?*', 'type' => 'radio'],
			['category_id' => '11', 'question' => 'What type of facility requires flooring / tiling services?*', 'type' => 'radio'],
			['category_id' => '11', 'question' => 'What is the approximate area of the current floor or tiles needing repair / required new floor or tiles (in square feet)?*', 'type' => 'radio'],

/*51*/	
			['category_id' => '11', 'question' => 'Does your floor or tiling area have any special features?*', 'type' => 'checkbox'],
			['category_id' => '11', 'question' => 'Will you provide all necessary materials and parts?*', 'type' => 'radio'],
			/*Food & beverage catering*/
			['category_id' => '12', 'question' => 'What kind of event do you want the catering for?*', 'type' => 'radio'],
			['category_id' => '12', 'question' => 'What dishes and beverages do you need catered?*', 'type' => 'checkbox'],
			['category_id' => '12', 'question' => 'What type of cuisine do you want catered?*', 'type' => 'checkbox'],


			['category_id' => '12', 'question' => 'What type of service do you require?*', 'type' => 'radio'],
			['category_id' => '12', 'question' => 'How many guests are expected?*', 'type' => 'radio'],
			['category_id' => '12', 'question' => 'How often do you need F&B catering service?*', 'type' => 'checkbox'],
			/*Gardening & Landscaping*/
			['category_id' => '13', 'question' => 'What gardening / landscaping services do you want?*', 'type' => 'checkbox'],
			['category_id' => '13', 'question' => 'What specific services are you looking for?*', 'type' => 'checkbox'],

/*61*/
			['category_id' => '13', 'question' => 'What type of facility requires gardening / landscaping?*', 'type' => 'radio'],
			['category_id' => '13', 'question' => 'Which areas requires gardening / landscaping?*', 'type' => 'radio'],
			['category_id' => '13', 'question' => 'What is the size of the garden / landscape (in square feet)?*', 'type' => 'radio'],
			['category_id' => '13', 'question' => 'How often do you need the gardening / landscpaing services?*', 'type' => 'checkbox'],
			/*Househelp & Maids*/
			['category_id' => '14', 'question' => 'What kind of househelp or maid do you require?*', 'type' => 'checkbox'],


			['category_id' => '14', 'question' => 'What is the frequency of service expected from the househelp or maid?*', 'type' => 'radio'],
			['category_id' => '14', 'question' => 'What qualifications do you expect the maid/ helper to have?*', 'type' => 'radio'],
			['category_id' => '14', 'question' => 'What relevant work experience do you expect the maid/ helper to have?*', 'type' => 'radio'],
			/*Mobile & Tablets*/
			['category_id' => '15', 'question' => 'What kind of device do you have?*', 'type' => 'radio'],
			['category_id' => '15', 'question' => 'What platform is your device on?*', 'type' => 'radio'],

/*71*/
			['category_id' => '15', 'question' => 'What type of brand is the device?*', 'type' => 'drop'],
			['category_id' => '15', 'question' => 'What is the model number of the device?*', 'type' => 'text'], /*72*/
			['category_id' => '15', 'question' => 'What type of help do you require with this device?*', 'type' => 'checkbox'],
			/*Packing & Moving*/
			['category_id' => '16', 'question' => 'Where are you moving from - current location ? (Please provide State / City / Town)?*', 'type' => 'text'], /*74*/
			['category_id' => '16', 'question' => 'Where are you moving to - destination location ? (Please provide State / City / Town)?*', 'type' => 'text'], /*75*/



			['category_id' => '16', 'question' => 'What would you like to move?*', 'type' => 'drop'],
			['category_id' => '16', 'question' => 'What specific services would you require?*', 'type' => 'checkbox'],
			['category_id' => '16', 'question' => 'What is the approximate total weight of the items that need movement?*', 'type' => 'radio'],
			['category_id' => '16', 'question' => 'Does your current location have stairs?*', 'type' => 'radio'],
			['category_id' => '16', 'question' => 'Does your destination location have stairs?*', 'type' => 'radio'],

/*81*/
			/*Pest control*/
			['category_id' => '17', 'question' => 'What kind of pest prroblem do you have?*', 'type' => 'checkbox'],
			['category_id' => '17', 'question' => 'What services do you need?*', 'type' => 'checkbox'],
			['category_id' => '17', 'question' => 'What type of facility requires pest control*', 'type' => 'radio'],
			['category_id' => '17', 'question' => 'What is the size of the facility (in square feet)?*', 'type' => 'radio'],
			['category_id' => '17', 'question' => 'What are the affected areas?*', 'type' => 'checkbox'],


			/*Photography & Video Filming*/
			['category_id' => '18', 'question' => 'For what purpose are the photogrpahy / videofiliming services required?*', 'type' => 'drop'],
			['category_id' => '18', 'question' => 'What type and style of services are you interested in?*', 'type' => 'radio'],
			['category_id' => '18', 'question' => 'How many hours do you need the services for?*', 'type' => 'radio'],
			['category_id' => '18', 'question' => 'If for an event, how many people will be attending?*', 'type' => 'radio'],
			['category_id' => '18', 'question' => 'Is the shoot required indoors or outdoors?*', 'type' => 'radio'],

/*91*/
			['category_id' => '18', 'question' => 'In what formats do you want your images?*', 'type' => 'radio'],
			/*Plumbing & Drainage*/
			['category_id' => '19', 'question' => 'What kind of help do you need with plumbing & drainage?*', 'type' => 'radio'],
			['category_id' => '19', 'question' => 'What fittings does the provider need to work on?*', 'type' => 'drop'],
			['category_id' => '19', 'question' => 'What type of facility requires plumbing and drainage services?*', 'type' => 'drop'],
			['category_id' => '19', 'question' => 'Where do you want to install / repair the plumbing fittings?*', 'type' => 'checkbox'],


			['category_id' => '19', 'question' => 'Will you provide all necessary materials and parts?*', 'type' => 'radio'],
			/*Printing & Design*/
			['category_id' => '20', 'question' => 'What type of service do you you need?*', 'type' => 'radio'],
			['category_id' => '20', 'question' => 'What do you need printed / designed / bound / photocopied?*', 'type' => 'checkbox'],
			['category_id' => '20', 'question' => 'What kind of entity needs this service(s)?*', 'type' => 'radio'],
			['category_id' => '20', 'question' => 'How many units / pages do you want to print / bind / design / photocopy?*', 'type' => 'radio'],

/*101*/

			
			['category_id' => '20', 'question' => 'What size of the print / design / photocopy / bind do you require?*', 'type' => 'drop'],
			['category_id' => '20', 'question' => 'What kind of design options do you need?*', 'type' => 'radio'],
			['category_id' => '21', 'question' => 'What kind of help do you need with the roof?*', 'type' => 'checkbox'],
			['category_id' => '21', 'question' => 'What is the size of the current roof needing repair / required new roof (in square feet)?*', 'type' => 'radio'],
			['category_id' => '21', 'question' => 'What material is the current roof / required for the new roof?*', 'type' => 'radio'],


			/*Roofing*/
			['category_id' => '21', 'question' => 'What type of facility requires roofing services?*', 'type' => 'radio'],
			['category_id' => '21', 'question' => 'How steep is your current roof / required new roof?*', 'type' => 'checkbox'],
			['category_id' => '21', 'question' => 'What kind of structures are on the current roof / expected on the new roof?*', 'type' => 'radio'],
			['category_id' => '21', 'question' => 'Will you provide all necessary materials and parts?*', 'type' => 'radio'],
			/*Security*/
			['category_id' => '22', 'question' => 'What type of security services do you require?*', 'type' => 'radio'],

/*111*/
			['category_id' => '22', 'question' => 'Which facility requires security services?*', 'type' => 'drop'],
			['category_id' => '22', 'question' => 'What is the size of the facility (in square feet)?*', 'type' => 'radio'],
			['category_id' => '22', 'question' => 'How many points in the facility require security guard services or security and alarm equipemt?*', 'type' => 'radio'],
			['category_id' => '22', 'question' => 'If Security Guard Services are required, what is the duration?*', 'type' => 'radio'],
			['category_id' => '22', 'question' => 'If Security and Alarms Equipment Services are required, what component(s) do you require assistance with?*', 'type' => 'drop'],


			/*Tutoring*/
			['category_id' => '23', 'question' => 'What grade is the student in?*', 'type' => 'drop'],
			['category_id' => '23', 'question' => 'What subject does the student need help with?*', 'type' => 'checkbox'],
			['category_id' => '23', 'question' => 'What is the reason for requesting a tutor?*', 'type' => 'checkbox'],
			['category_id' => '23', 'question' => 'How often would you like to meet?*', 'type' => 'checkbox'],
			['category_id' => '23', 'question' => 'What are the best days to meet?*', 'type' => 'checkbox'],

/*121*/
			['category_id' => '23', 'question' => 'What are the best times to meet?*', 'type' => 'radio'],
			['category_id' => '23', 'question' => 'Do you want to learn in a class or group?*', 'type' => 'radio'],
			['category_id' => '24', 'question' => 'What events would you like to work on?*', 'type' => 'checkbox'],
			['category_id' => '24', 'question' => 'What do you need help with?*', 'type' => 'checkbox'],
			['category_id' => '24', 'question' => 'What services would you like the planner to assist with?*', 'type' => 'checkbox'],


			/*Wedding*/
			['category_id' => '24', 'question' => 'How many guests are expected?*', 'type' => 'radio'],
			/*Others*/
			['category_id' => '25', 'question' => 'Cannot find the service category you are looking for? Please fill in the details of the service you require and we will find you the most reliable and cost effective provider.*', 'type' => 'text'], /*129*/

        ];
		foreach ($questions as $question) {
			Question::insert([
				$question
			]);
		}
    }
}
