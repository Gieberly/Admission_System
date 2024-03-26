<?php
                                    // Check if the query was successful
                                    if ($resultEthnicity && $resultEthnicity->num_rows > 0) {
                                        while ($rowEthnicity = $resultEthnicity->fetch_assoc()) {
                                            $ethnicity = $rowEthnicity['ethnicity_name'];
                                            echo "<option value=\"$ethnicity\">$ethnicity</option>";
                                        }
                                    } else {
                                        echo "<option value=\"\">No Ethnicity found</option>";
                                    }