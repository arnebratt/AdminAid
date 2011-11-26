<?php /* #?ini charset="utf-8"?

[Aid]
# Only users with ID listed here can use user switch function
UserSwitchIDLimit[]
UserSwitchIDLimit[]=14

# Classes representing a user
UserClass[]
UserClass[]=user

# Enable IP limitations on user switch
LimitByIP=disabled
IPList[]
#IPList[]=127.0.0.1

# Specify which tables to search and which columns in each table
[SearchDatabase]
# List of classes to use when searching
ClassList[]
# Specify column for id to search on each table
TableID[]
# Specify column for text to search on each table
TableText[]

ClassList[]=eZContentObject
TableID[eZContentObject]=id
TableText[eZContentObject]=name

ClassList[]=eZContentObjectTreeNode
TableID[eZContentObjectTreeNode]=node_id
TableText[eZContentObjectTreeNode]=path_identification_string

ClassList[]=eZContentObjectAttribute
TableID[eZContentObjectAttribute]=id
TableText[eZContentObjectAttribute]=data_text

ClassList[]=eZContentObjectVersion
TableID[eZContentObjectVersion]=id

ClassList[]=eZContentClass
TableID[eZContentClass]=id
TableText[eZContentClass]=serialized_name_list

ClassList[]=eZContentClassAttribute
TableID[eZContentClassAttribute]=id
TableText[eZContentClassAttribute]=serialized_name_list

ClassList[]=eZUser
TableID[eZUser]=contentobject_id
TableText[eZUser]=login

ClassList[]=eZContentObjectState
TableID[eZContentObjectState]=id
TableText[eZContentObjectState]=identifier

ClassList[]=eZContentObjectStateGroup
TableID[eZContentObjectStateGroup]=id
TableText[eZContentObjectStateGroup]=identifier

ClassList[]=eZContentObjectStateLanguage
TableID[eZContentObjectStateLanguage]=contentobject_state_id
TableText[eZContentObjectStateLanguage]=name

ClassList[]=eZContentObjectStateGroupLanguage
TableID[eZContentObjectStateGroupLanguage]=contentobject_state_group_id
TableText[eZContentObjectStateGroupLanguage]=name

ClassList[]=eZContentLanguage
TableID[eZContentLanguage]=id
TableText[eZContentLanguage]=name

ClassList[]=eZContentBrowseBookmark
TableID[eZContentBrowseBookmark]=id
TableText[eZContentBrowseBookmark]=name

ClassList[]=eZImageFile
TableID[eZImageFile]=id
TableText[eZImageFile]=filepath

ClassList[]=eZInformationCollectionAttribute
TableID[eZInformationCollectionAttribute]=id
TableText[eZInformationCollectionAttribute]=data_text

ClassList[]=eZNodeAssignment
TableID[eZNodeAssignment]=id

ClassList[]=eZURL
TableID[eZURL]=id
TableText[eZURL]=url

ClassList[]=eZUrlAliasML
TableID[eZUrlAliasML]=id
TableText[eZUrlAliasML]=text

ClassList[]=eZWorkflow
TableID[eZWorkflow]=id
TableText[eZWorkflow]=name

*/ ?>
