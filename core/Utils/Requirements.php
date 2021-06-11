<?php
/**
 * @package     PublishPress\Checklists
 * @author      PublishPress <help@publishpress.com>
 * @copyright   copyright (C) 2019 PublishPress. All rights reserved.
 * @license     GPLv2 or later
 * @since       1.0.0
 */

namespace PublishPress\Checklists\Core\Utils;


class Requirements
{
    /**
     * Rearrange the requirements array by custom order
     *
     * @param array $requirements
     * @param boolean $isOnMetabox
     */
    public function rearrangeRequirementArray($requirements, $isOnMetabox = true)
    {
        $options = (array)get_option('publishpress_checklists_checklists_options');

        $requirementRuleArray = [];
        $newRequirementsArray = [];

        if ($isOnMetabox) {
            foreach ($requirements as $requirementKey => $requirement) {
                $requirementRuleArray[$requirementKey . '_rule'] = $requirementKey;
            }
        } else {
            $index = 0;
            foreach ($requirements as $requirement) {
                $requirementRuleArray[$requirement->name . '_rule'] = $index++;
            }
        }

        $newArray = array_intersect_key($options, $requirementRuleArray);

        $requirementRuleArray = array_merge(array_flip(array_keys($newArray)), $requirementRuleArray);

        $index = 0;
        foreach ($requirementRuleArray as $reqIndex) {
            $newIndex                        = ($isOnMetabox) ? $reqIndex : $index++;
            $newRequirementsArray[$newIndex] = $requirements[$reqIndex];
        }

        return $newRequirementsArray;
    }
}
