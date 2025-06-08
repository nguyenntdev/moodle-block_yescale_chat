<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * General plugin functions
 *
 * @package    block_openai_chat
 * @copyright  2023 Bryce Yoder <me@bryceyoder.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Fetch the current API type from the database, defaulting to "chat"
 * @return String: the API type (chat|azure|assistant)
 */
function get_type_to_display() {
    $stored_type = get_config('block_openai_chat', 'type');
    if ($stored_type) {
        return $stored_type;
    }
    
    return 'chat';
}

/**
 * Use an API key to fetch a list of assistants from a user's OpenAI account
 * @param Int (optional): The ID of a block instance. If this is passed, the API can be pulled from the block rather than the site level.
 * @return Array: The list of assistants
 */
function fetch_assistants_array($block_id = null) {
    global $DB;

    if (!$block_id) {
        $apikey = get_config('block_openai_chat', 'apikey');
    } else {
        $instance_record = $DB->get_record('block_instances', ['blockname' => 'openai_chat', 'id' => $block_id], '*');
        $instance = block_instance('openai_chat', $instance_record);
        $apikey = $instance->config->apikey ? $instance->config->apikey : get_config('block_openai_chat', 'apikey');
    }

    if (!$apikey) {
        return [];
    }

    $curl = new \curl();
    $curl->setopt(array(
        'CURLOPT_HTTPHEADER' => array(
            'Authorization: Bearer ' . $apikey,
            'Content-Type: application/json',
            'OpenAI-Beta: assistants=v2'
        ),
    ));

    $response = $curl->get("https://api.yescale.io/v1/assistants?order=desc");
    $response = json_decode($response);
    $assistant_array = [];
    if (property_exists($response, 'data')) {
        foreach ($response->data as $assistant) {
            $assistant_array[$assistant->id] = $assistant->name;
        }
    }

    return $assistant_array;
}

/**
 * Return a list of available models, and the type of each model.
 * (Type used to be relevant before OpenAI released the Assistant API. Currently it is no longer useful as all models are of type "chat,"
 * but I left it here in case the API is changed significantly in the future)
 * @return Array: The list of model info
 */
function get_models() {
    return [
        "models" => [
            'gpt-4o' => 'gpt-4o',
            'gpt-4o-mini' => 'gpt-4o-mini',
            'gpt-4.1-2025-04-14' => 'gpt-4.1-2025-04-14',
            'gpt-4.1-mini-2025-04-14' => 'gpt-4.1-mini-2025-04-14',
            'gpt-4.1-nano-2025-04-14' => 'gpt-4.1-nano-2025-04-14',
            'gpt-4-turbo' => 'gpt-4-turbo',
            'gpt-3.5-turbo' => 'gpt-3.5-turbo',
            'gpt-4' => 'gpt-4',
            'claude-opus-4-20250514' => 'claude-opus-4-20250514',
            'claude-sonnet-4-20250514' => 'claude-sonnet-4-20250514',
            'claude-3-7-sonnet-20250219-thinking' => 'claude-3-7-sonnet-20250219-thinking',
            'deepseek-r1-0528' => 'deepseek-r1-0528',
            'deepseek-v3-0324' => 'deepseek-v3-0324',
            'gemini-2.0-flash' => 'gemini-2.0-flash',
            'gemini-2.0-flash-lite' => 'gemini-2.0-flash-lite',
            'gemini-2.5-pro-preview-05-06' => 'gemini-2.5-pro-preview-05-06',
            'grok-3-beta' => 'grok-3-beta',
            'grok-3-deepsearch' => 'grok-3-deepsearch',
            'grok-3-mini-fast-beta' => 'grok-3-mini-fast-beta',
            'grok-3-reasoner' => 'grok-3-reasoner',
            'tts-1' => 'tts-1',
            'tts-1-hd' => 'tts-1-hd',
            'whisper-1' => 'whisper-1',
            'gpt-4.5-preview' => 'gpt-4.5-preview',
            'o1-preview' => 'o1-preview',
            'o3-mini' => 'o3-mini',
            'imagen-3.0-generate-002' => 'imagen-3.0-generate-002',
        ],
        "types" => [
            'gpt-4o'                     => 'chat',
            'gpt-4o-mini'                => 'chat',
            'gpt-4.1-2025-04-14'         => 'chat',
            'gpt-4.1-mini-2025-04-14'    => 'chat',
            'gpt-4.1-nano-2025-04-14'    => 'chat',
            'gpt-4-turbo'                => 'chat',
            'gpt-3.5-turbo'              => 'chat',
            'gpt-4'                      => 'chat',
            'claude-opus-4-20250514'     => 'chat',
            'claude-sonnet-4-20250514'   => 'chat',
            'claude-3-7-sonnet-20250219-thinking' => 'chat',
            'deepseek-r1-0528'           => 'chat',
            'deepseek-v3-0324'           => 'chat',
            'gemini-2.0-flash'           => 'chat',
            'gemini-2.0-flash-lite'      => 'chat',
            'gemini-2.5-pro-preview-05-06' => 'chat',
            'grok-3-beta'                => 'chat',
            'grok-3-deepsearch'          => 'chat',
            'grok-3-mini-fast-beta'      => 'chat',
            'grok-3-reasoner'            => 'chat',
            'tts-1'                      => 'audio',
            'tts-1-hd'                   => 'audio',
            'whisper-1'                  => 'audio',
            'gpt-4.5-preview'            => 'chat',
            'o1-preview'                 => 'chat',
            'o3-mini'                    => 'chat',
            'imagen-3.0-generate-002'    => 'image',
        ]

    ];
}

/**
 * If setting is enabled, log the user's message and the AI response
 * @param string usermessage: The text sent from the user
 * @param string airesponse: The text returned by the AI 
 */
function log_message($usermessage, $airesponse, $context) {
    global $USER, $DB;

    if (!get_config('block_openai_chat', 'logging')) {
        return;
    }

    $DB->insert_record('block_openai_chat_log', (object) [
        'userid' => $USER->id,
        'usermessage' => $usermessage,
        'airesponse' => $airesponse,
        'contextid' => $context->id,
        'timecreated' => time()
    ]);
}

function block_openai_chat_extend_navigation_course($nav, $course, $context) {
    if ($nav->get('coursereports')) {
        $nav->get('coursereports')->add(
            get_string('openai_chat_logs', 'block_openai_chat'),
            new moodle_url('/blocks/openai_chat/report.php', ['courseid' => $course->id]),
            navigation_node::TYPE_SETTING,
            null
        );
    }
}

/**
 * Trả về endpoint mặc định cho từng nhóm model dựa trên prefix model
 * @param string $model
 * @return string endpoint URL
 */
function get_model_endpoint($model) {
    // Tất cả endpoint đều dùng yescale
    if (strpos($model, 'tts-') === 0 || strpos($model, 'whisper-') === 0) {
        return 'https://api.yescale.io/v1/audio/transcriptions';
    }
    if (strpos($model, 'imagen-') === 0) {
        return 'https://api.yescale.io/v1/image/generate';
    }
    // Mặc định cho các model chat
    return 'https://api.yescale.io/v1/chat/completions';
}
