<?php namespace Jenssegers\Mongodb\Auth;

use MongoDB\BSON\UTCDateTime;
use DateTime;
use DateTimeZone;

class DatabaseReminderRepository extends \Illuminate\Auth\Reminders\DatabaseReminderRepository {

	/**
	 * Build the record payload for the table.
	 *
	 * @param  string  $email
	 * @param  string  $token
	 * @return array
	 */
	protected function getPayload($email, $token)
	{
		return ['email' => $email, 'token' => $token, 'created_at' => new UTCDateTime(round(microtime(true) * 1000))];
	}

	/**
	 * Determine if the reminder has expired.
	 *
	 * @param  object  $reminder
	 * @return bool
	 */
	protected function reminderExpired($reminder)
	{
		// Convert UTCDateTime to a date string.
        if ($token['created_at'] instanceof UTCDateTime) {
            $date = $token['created_at']->toDateTime();
            $date->setTimezone(new DateTimeZone(date_default_timezone_get()));
            $reminder['created_at'] = $date->format('Y-m-d H:i:s');
        } elseif (is_array($token['created_at']) and isset($token['created_at']['date'])) {
            $date = new DateTime($token['created_at']['date'], new DateTimeZone(isset($token['created_at']['timezone']) ? $token['created_at']['timezone'] : 'UTC'));
            $date->setTimezone(new DateTimeZone(date_default_timezone_get()));
            $reminder['created_at'] = $date->format('Y-m-d H:i:s');
        }

		return parent::reminderExpired($reminder);
	}

}
