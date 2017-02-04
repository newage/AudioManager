<?php

namespace AudioManager\Adapter;

use AudioManager\Adapter\Options\OptionsInterface;
use Aws\Polly\PollyClient;

/**
 * Class Polly
 * @package AudioManager\Adapter
 */
class Polly extends AbstractAdapter implements AdapterInterface
{
    /**
     * Get audio for text from adapter
     * @param string $text
     * @return mixed
     */
    public function read($text)
    {
        $pollyClient = new PollyClient([
            'version' => 'latest',
            'region'  => 'us-west-2'
        ]);
        $result = $pollyClient->createSynthesizeSpeechPreSignedUrl([]);
        return $result;
    }

    /**
     * Init options
     * @return OptionsInterface
     */
    protected function initOptions()
    {
        // TODO: Implement initOptions() method.
    }
}
