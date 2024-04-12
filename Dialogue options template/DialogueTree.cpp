#include <limits>
#include "DialogueTree.h"
DialogueOptions::DialogueOptions(string PlayerDialogue, int Reply, DialogueNode *Next){
    playerDialogue = PlayerDialogue;
    reply = Reply;
    next = Next;
}

DialogueTree::DialogueTree() {}


/*
 *  I have hard coded the init function for this. if you have many dialogues
 *  then I would recommend using an external file like a .csv or .ini file for
 *  the different npc dialogues and responses.
 *  If not, you can add as many nodes and paths/pointers here.
*/
void DialogueTree::init() {
    DialogueNode *node0 = new DialogueNode;
    node0->npcDialogue = "Dummy Dialogue 1";
    DialogueNode *node1 = new DialogueNode;
    node1->npcDialogue = "Dummy Dialogue 2";
    DialogueNode *node2 = new DialogueNode;
    node2->npcDialogue = "Dummy Dialogue 3";
    DialogueNode *node3 = new DialogueNode;
    node3->npcDialogue = "Dummy Dialogue 4";

    node0->options.push_back(DialogueOptions("Dummy Response 1", 0, node1));
    node0->options.push_back(DialogueOptions("Dummy Response 2", 0, node2));
    nodes.push_back(node0);

    node1->options.push_back(DialogueOptions("Dummy End of Dialogue", 0, nullptr));
    nodes.push_back(node1);

    node2->options.push_back(DialogueOptions("Dummy End of Dialogue", 0, nullptr));
    node2->options.push_back(DialogueOptions("Dummy Response 3", 0, node3));
    nodes.push_back(node2);

    node3->options.push_back(DialogueOptions("Dummy Confirmation option", 1, nullptr));
    node3->options.push_back(DialogueOptions("Dummy End of Dialogue", 0, nullptr));
    nodes.push_back(node3);
}

void DialogueTree::empty() {
    for (int i = 0; i < nodes.size() ; i++) {
        delete nodes[i];
    }
    nodes.clear();
}

int DialogueTree::result() {
    if(nodes.empty()){
        return -1;
    }

    DialogueNode *currentNode = nodes[0];

    while (true){

        cout << currentNode->npcDialogue << "\n\n";

        /*
         * using this method for testing for now. when you implement this in the game then
         * you can change the input method to whatever is preferred
        */
        for (int i = 0; i < currentNode->options.size(); i++){
            cout << i+1 << ": " << currentNode->options[i].playerDialogue << endl;
        }
        cout << endl;
        int input;
        if (!(cin >> input)) {
            cin.clear();
            cin.ignore(std::numeric_limits<std::streamsize>::max(), '\n');
            cout << "Invalid input. Please enter a number." << endl;
            continue;
        }

        input--;

        if (input < 0 || input > currentNode->options.size()){
            cout << "invalid";
        }else{
            if (currentNode->options[input].next == nullptr){
                return currentNode->options[input].reply;
            }
            currentNode = currentNode->options[input].next;
        }
        cout << endl;
    }
}

