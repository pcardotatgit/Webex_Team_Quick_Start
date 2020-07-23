from ciscosparkapi import CiscoSparkAPI

api = CiscoSparkAPI()

# Find all rooms that have 'ciscosparkapi Demo' in their title
all_rooms = api.rooms.list()
demo_rooms = [room for room in all_rooms if 'ciscosparkapi Demo' in room.title]

# Delete all of the demo rooms
for room in demo_rooms:
    api.rooms.delete(room.id)

# Create a new demo room
demo_room = api.rooms.create('ciscosparkapi Demo')

# Add people to the new demo room
email_addresses = ["test01@test.com", "test02@test.com"]
for email in email_addresses:
    api.memberships.create(demo_room.id, personEmail=email)

# Post a message to the new room, and upload a file
api.messages.create(demo_room.id, text="Welcome to the room!",
                    files=["https://example.com/images/example.png"])