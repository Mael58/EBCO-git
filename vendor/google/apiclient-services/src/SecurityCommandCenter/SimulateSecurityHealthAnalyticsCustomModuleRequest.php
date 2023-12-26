<?php
/*
 * Copyright 2014 Google Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License"); you may not
 * use this file except in compliance with the License. You may obtain a copy of
 * the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations under
 * the License.
 */

namespace Google\Service\SecurityCommandCenter;

class SimulateSecurityHealthAnalyticsCustomModuleRequest extends \Google\Model
{
  /**
   * @var GoogleCloudSecuritycenterV1CustomConfig
   */
  public $customConfig;
  protected $customConfigType = GoogleCloudSecuritycenterV1CustomConfig::class;
  protected $customConfigDataType = '';
  /**
   * @var SimulatedResource
   */
  public $resource;
  protected $resourceType = SimulatedResource::class;
  protected $resourceDataType = '';

  /**
   * @param GoogleCloudSecuritycenterV1CustomConfig
   */
  public function setCustomConfig(GoogleCloudSecuritycenterV1CustomConfig $customConfig)
  {
    $this->customConfig = $customConfig;
  }
  /**
   * @return GoogleCloudSecuritycenterV1CustomConfig
   */
  public function getCustomConfig()
  {
    return $this->customConfig;
  }
  /**
   * @param SimulatedResource
   */
  public function setResource(SimulatedResource $resource)
  {
    $this->resource = $resource;
  }
  /**
   * @return SimulatedResource
   */
  public function getResource()
  {
    return $this->resource;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(SimulateSecurityHealthAnalyticsCustomModuleRequest::class, 'Google_Service_SecurityCommandCenter_SimulateSecurityHealthAnalyticsCustomModuleRequest');
