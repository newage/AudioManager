<?php

namespace AudioManager\Adapter;

use AudioManager\Adapter\Options\OptionsInterface;
use Aws\Polly\PollyClient;
use AudioManager\Adapter\Options\Polly as Options;

/**
 * Class Polly
 * @package AudioManager\Adapter
 * @method Options getOptions()
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
        $initializeOptions = $this->getOptions()->getInitializeOptions();
        $pollyClient = new PollyClient([
            'version' => $initializeOptions->getVersion(),
            'region' => $initializeOptions->getRegion(),
            'credentials' => [
                'key' => $initializeOptions->getCredentials()->getKey(),
                'secret' => $initializeOptions->getCredentials()->getSecret()
            ]
        ]);

        $synthesizeOptions = [
            'OutputFormat' => $this->getOptions()->getOutputFormat(),
            'Text' => $text,
            'TextType' => $this->getOptions()->getTextType(),
            'VoiceId' => $this->getOptions()->getVoiceId(),
            'VoiceLanguageCode' => $this->getOptions()->getLanguage(),
            'SampleRate' => $this->getOptions()->getSampleRate(),
            'Engine' => $this->getOptions()->getEngine(),
        ];
        if (!empty($this->getOptions()->getLexiconNames())) {
            $synthesizeOptions['LexiconNames'] = $this->getOptions()->getLexiconNames();
        }

        $awsResult = $pollyClient->synthesizeSpeech($synthesizeOptions);
        $this->setHeaders($awsResult->get('@metadata'));
        $stream = $awsResult->get('AudioStream');
        return $stream->getContents();
    }

    /**
     * Init options
     * @return OptionsInterface
     */
    protected function initOptions()
    {
        return new Options();
    }

    public function getHeaders()
    {
        $headers = parent::getHeaders();
        return array_merge(
            $headers,
            [
                'http_code' => isset($headers['statusCode']) ? $headers['statusCode']: 500,
            ]
        );
    }
}
