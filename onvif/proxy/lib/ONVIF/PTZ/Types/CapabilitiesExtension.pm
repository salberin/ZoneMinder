package ONVIF::PTZ::Types::CapabilitiesExtension;
use strict;
use warnings;


__PACKAGE__->_set_element_form_qualified(1);

sub get_xmlns { 'http://www.onvif.org/ver10/schema' };

our $XML_ATTRIBUTE_CLASS;
undef $XML_ATTRIBUTE_CLASS;

sub __get_attr_class {
    return $XML_ATTRIBUTE_CLASS;
}

use Class::Std::Fast::Storable constructor => 'none';
use base qw(SOAP::WSDL::XSD::Typelib::ComplexType);

Class::Std::initialize();

{ # BLOCK to scope variables

my %DeviceIO_of :ATTR(:get<DeviceIO>);
my %Display_of :ATTR(:get<Display>);
my %Recording_of :ATTR(:get<Recording>);
my %Search_of :ATTR(:get<Search>);
my %Replay_of :ATTR(:get<Replay>);
my %Receiver_of :ATTR(:get<Receiver>);
my %AnalyticsDevice_of :ATTR(:get<AnalyticsDevice>);
my %Extensions_of :ATTR(:get<Extensions>);

__PACKAGE__->_factory(
    [ qw(        DeviceIO
        Display
        Recording
        Search
        Replay
        Receiver
        AnalyticsDevice
        Extensions

    ) ],
    {
        'DeviceIO' => \%DeviceIO_of,
        'Display' => \%Display_of,
        'Recording' => \%Recording_of,
        'Search' => \%Search_of,
        'Replay' => \%Replay_of,
        'Receiver' => \%Receiver_of,
        'AnalyticsDevice' => \%AnalyticsDevice_of,
        'Extensions' => \%Extensions_of,
    },
    {
        'DeviceIO' => 'ONVIF::PTZ::Types::DeviceIOCapabilities',
        'Display' => 'ONVIF::PTZ::Types::DisplayCapabilities',
        'Recording' => 'ONVIF::PTZ::Types::RecordingCapabilities',
        'Search' => 'ONVIF::PTZ::Types::SearchCapabilities',
        'Replay' => 'ONVIF::PTZ::Types::ReplayCapabilities',
        'Receiver' => 'ONVIF::PTZ::Types::ReceiverCapabilities',
        'AnalyticsDevice' => 'ONVIF::PTZ::Types::AnalyticsDeviceCapabilities',
        'Extensions' => 'ONVIF::PTZ::Types::CapabilitiesExtension2',
    },
    {

        'DeviceIO' => 'DeviceIO',
        'Display' => 'Display',
        'Recording' => 'Recording',
        'Search' => 'Search',
        'Replay' => 'Replay',
        'Receiver' => 'Receiver',
        'AnalyticsDevice' => 'AnalyticsDevice',
        'Extensions' => 'Extensions',
    }
);

} # end BLOCK








1;


=pod

=head1 NAME

ONVIF::PTZ::Types::CapabilitiesExtension

=head1 DESCRIPTION

Perl data type class for the XML Schema defined complexType
CapabilitiesExtension from the namespace http://www.onvif.org/ver10/schema.






=head2 PROPERTIES

The following properties may be accessed using get_PROPERTY / set_PROPERTY
methods:

=over

=item * DeviceIO


=item * Display


=item * Recording


=item * Search


=item * Replay


=item * Receiver


=item * AnalyticsDevice


=item * Extensions




=back


=head1 METHODS

=head2 new

Constructor. The following data structure may be passed to new():

 { # ONVIF::PTZ::Types::CapabilitiesExtension
   DeviceIO =>  { # ONVIF::PTZ::Types::DeviceIOCapabilities
     XAddr =>  $some_value, # anyURI
     VideoSources =>  $some_value, # int
     VideoOutputs =>  $some_value, # int
     AudioSources =>  $some_value, # int
     AudioOutputs =>  $some_value, # int
     RelayOutputs =>  $some_value, # int
   },
   Display =>  { # ONVIF::PTZ::Types::DisplayCapabilities
     XAddr =>  $some_value, # anyURI
     FixedLayout =>  $some_value, # boolean
   },
   Recording =>  { # ONVIF::PTZ::Types::RecordingCapabilities
     XAddr =>  $some_value, # anyURI
     ReceiverSource =>  $some_value, # boolean
     MediaProfileSource =>  $some_value, # boolean
     DynamicRecordings =>  $some_value, # boolean
     DynamicTracks =>  $some_value, # boolean
     MaxStringLength =>  $some_value, # int
   },
   Search =>  { # ONVIF::PTZ::Types::SearchCapabilities
     XAddr =>  $some_value, # anyURI
     MetadataSearch =>  $some_value, # boolean
   },
   Replay =>  { # ONVIF::PTZ::Types::ReplayCapabilities
     XAddr =>  $some_value, # anyURI
   },
   Receiver =>  { # ONVIF::PTZ::Types::ReceiverCapabilities
     XAddr =>  $some_value, # anyURI
     RTP_Multicast =>  $some_value, # boolean
     RTP_TCP =>  $some_value, # boolean
     RTP_RTSP_TCP =>  $some_value, # boolean
     SupportedReceivers =>  $some_value, # int
     MaximumRTSPURILength =>  $some_value, # int
   },
   AnalyticsDevice =>  { # ONVIF::PTZ::Types::AnalyticsDeviceCapabilities
     XAddr =>  $some_value, # anyURI
     RuleSupport =>  $some_value, # boolean
     Extension =>  { # ONVIF::PTZ::Types::AnalyticsDeviceExtension
     },
   },
   Extensions =>  { # ONVIF::PTZ::Types::CapabilitiesExtension2
   },
 },




=head1 AUTHOR

Generated by SOAP::WSDL

=cut
