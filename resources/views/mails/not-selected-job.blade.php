

<p>Select a provider</p>

@foreach($descs as $desc)

<p>Please go to Mr Shasha and select a provider for the job {{$desc->description}}</p>

<p>
	<a href="{{action('SeekersController@getSeekerJob',$desc->id)}}">Link to job here</a>
</p>
@endforeach