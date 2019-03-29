Hallo {{ $event->provider_name }},

du hast eine Buchung erhalten! 

Customer: {{ $booked->customer_name }}

Aktivitäts Details
__________________

Aktivitätsname: {{ $booked->event_name }}
Platz: {{ $booked->city }}
Koste: {{ $booked->cost }}
Stornierungsbedingungen: {{ $booked->cancellation_policy }}

Solltest du Fragen an uns haben, kannst du uns gern per E-Mail unter hello@kidwedo.de erreichen.

Mit besten Grüßen
Dein Kidwedo-Team

__________________________________

Kidwedo
Akazienstrasse 3A
10823 Berlin
E-Mail: hello@kidwedo.de