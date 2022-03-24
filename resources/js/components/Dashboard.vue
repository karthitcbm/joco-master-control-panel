<template>
    <v-app>
    <v-data-table
    :headers="headers"
    :items="tableData"
    sort-by="calories"
    class="elevation-24"
  >
    <template v-slot:top>
      <v-toolbar flat>
        <v-toolbar-title>Users List</v-toolbar-title>
        <v-spacer></v-spacer>
        <v-dialog
          v-model="dialog"
          max-width="500px"
        >
          <template v-slot:activator="{ on, attrs }">
            <v-btn
              color="primary"
              dark
              class="mb-2"
              v-bind="attrs"
              v-on="on"
            >
            <v-icon left>
        mdi-account
      </v-icon>
              Add User
            </v-btn>
          </template>
          <v-card>
            <v-card-title>
              <span class="text-h5">{{ formTitle }}</span>
            </v-card-title>

            <v-card-text>
              <v-container>
                <v-row>
                  <v-col
                    cols="12"
                    sm="12"
                    md="12"
                  >
                    <v-text-field
                      v-model="editedItem.name"
                      label="Name"
                    ></v-text-field>
                  </v-col>
                  <v-col
                    cols="12"
                    sm="12"
                    md="12"
                  >
                    <v-text-field
                      v-model="editedItem.email"
                      label="Email"
                    ></v-text-field>
                  </v-col>
                  <v-col
                    cols="12"
                    sm="12"
                    md="12"
                  >
                    <v-select
                      v-model="editedItem.role"
                      :items="options"
                      label="Role"
                      outlined
                    ></v-select>
                  </v-col>
                  <v-col
                    cols="12"
                    sm="12"
                    md="12"
                    v-if="editedIndex === -1"
                  >
                    <v-text-field
                      v-model="editedItem.password"
                      label="Password"
                    ></v-text-field>
                  </v-col>
                </v-row>
              </v-container>
            </v-card-text>

            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn
                color="blue darken-1"
                text
                @click="close"
              >
                Cancel
              </v-btn>
              <v-btn
                color="blue darken-1"
                text
                @click="save"
              >
                Save
              </v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>
        <v-dialog v-model="dialogDelete" max-width="500px">
          <v-card>
            <v-card-title class="text-h5">Are you sure you want to delete?</v-card-title>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="blue darken-1" text @click="closeDelete">Cancel</v-btn>
              <v-btn color="blue darken-1" text @click="deleteItemConfirm">OK</v-btn>
              <v-spacer></v-spacer>
            </v-card-actions>
          </v-card>
        </v-dialog>
      </v-toolbar>
    </template>
    <template v-slot:item.actions="{ item }">
      <v-icon
        small
        class="mr-2"
        @click="editItem(item)"
      >
        mdi-pencil
      </v-icon>
      <v-icon
        small
        @click="deleteItem(item)"
      >
        mdi-delete
      </v-icon>
    </template>
    <template v-slot:no-data>
      <v-btn
        color="primary"
        @click="fetchData"
      >
        Reset
      </v-btn>
    </template>
  </v-data-table>
    </v-app>
</template>

<script>
  import { getUserList, addUser, updateUser, deleteUser } from '../services.js'
  export default {
    data: () => ({
      dialog: false,
      dialogDelete: false,
      options: ['Admin', 'CMS', 'FMS'],
      headers: [
        {
          text: 'Name',
          align: 'start',
          sortable: true,
          value: 'name',
        },
        { text: 'Email', value: 'email' },
        { text: 'Role', value: 'role' },
        { text: 'Created Date', value: 'created_at' },
        { text: 'Actions', value: 'actions', sortable: false },
      ],
      tableData: [],
      editedIndex: -1,
      editedItem: {
        name: '',
        email: '',
        role: '',
        password: '',
      },
      defaultItem: {
        name: '',
        email: '',
        role: '',
        password: '',
      },
    }),

    computed: {
      formTitle () {
        return this.editedIndex === -1 ? 'Add User' : 'Edit User'
      },
    },

    watch: {
      dialog (val) {
        val || this.close()
      },
      dialogDelete (val) {
        val || this.closeDelete()
      },
    },

    created () {
      this.fetchData()
    },

    methods: {

      fetchData () {
        getUserList().then((response) => {
          if(response.data !== undefined) {
            this.tableData = response.data;
          }
        }).catch((error) => {
          console.log(error);
        })
      },

      editItem (item) {
        this.editedIndex = this.tableData.indexOf(item)
        this.editedItem = Object.assign({}, item)
        this.dialog = true
      },

      deleteItem (item) {
        this.editedIndex = this.tableData.indexOf(item)
        this.editedItem = Object.assign({}, item)
        this.dialogDelete = true
      },

      deleteItemConfirm () {
        deleteUser(this.editedItem).then((response) => {
            if(response.data !== undefined) {
              this.fetchData();
            }
          }).catch((error) => {
            console.log(error);
        })
        // this.tableData.splice(this.editedIndex, 1)
        this.closeDelete()
      },

      close () {
        this.dialog = false
        this.$nextTick(() => {
          this.editedItem = Object.assign({}, this.defaultItem)
          this.editedIndex = -1
        })
      },

      closeDelete () {
        this.dialogDelete = false
        this.$nextTick(() => {
          this.editedItem = Object.assign({}, this.defaultItem)
          this.editedIndex = -1
        })
      },

      save () {
        if (this.editedIndex > -1) {
          updateUser(this.editedItem).then((response) => {
            if(response.data !== undefined) {
              this.fetchData();
            }
          }).catch((error) => {
            console.log(error);
          })
        } else {
          addUser(this.editedItem).then((response) => {
          if(response.data !== undefined) {
            this.fetchData();
          }
        }).catch((error) => {
          console.log(error);
        })
        }
        this.close()
      },
    },
  }
</script>